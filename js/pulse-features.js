(() => {
  'use strict';

  const pageId = document.body?.dataset.page || 'home';
  const bellButton = document.getElementById('pulseAlertToggle');
  const bellBadge = document.getElementById('pulseAlertBadge');
  const drawer = document.getElementById('pulseDrawer');
  const overlay = document.getElementById('pulseOverlay');
  const alertList = document.getElementById('pulseAlertList');
  const accountList = document.getElementById('pulseAccountList');
  const enableButton = document.getElementById('pulseEnableNotifications');
  const permissionState = document.getElementById('pulsePermissionState');
  const transcriptModal = document.getElementById('pulseTranscriptModal');
  const transcriptContent = document.getElementById('pulseTranscriptContent');
  const tabButtons = document.querySelectorAll('[data-pulse-tab]');
  const tabPanels = document.querySelectorAll('[data-pulse-panel]');
  const STORAGE_LAST_OPEN = `up_pulse_last_open_${pageId}`;
  const STORAGE_LAST_ALERT = `up_pulse_last_alert_${pageId}`;
  const STORAGE_ALLOW_BROWSER = 'up_pulse_browser_allowed';

  const state = {
    alerts: [],
    account: [],
    accountUnread: 0,
    activeTab: 'alerts',
    pollTimer: null
  };

  function formatTime(value) {
    const date = new Date(value);
    if (Number.isNaN(date.getTime())) return 'Just now';
    return date.toLocaleString('en-PH', { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit' });
  }

  function initials(name) {
    return (name || '?').trim().split(/\s+/).map(part => part[0]).join('').slice(0, 2).toUpperCase();
  }

  function setPermissionText() {
    if (!permissionState) return;
    if (!('Notification' in window)) {
      permissionState.textContent = 'Status: browser notifications are not supported here';
      if (enableButton) enableButton.disabled = true;
      return;
    }
    permissionState.textContent = `Status: ${Notification.permission}`;
  }

  function unreadAlertCount(alerts) {
    const lastOpen = Number(localStorage.getItem(STORAGE_LAST_OPEN) || 0);
    return alerts.filter((item) => new Date(item.time).getTime() > lastOpen).length;
  }

  function updateBadge() {
    if (!bellBadge) return;
    const total = unreadAlertCount(state.alerts) + Number(state.accountUnread || 0);
    if (total > 0) {
      bellBadge.hidden = false;
      bellBadge.textContent = total > 99 ? '99+' : String(total);
    } else {
      bellBadge.hidden = true;
      bellBadge.textContent = '0';
    }
  }

  function escapeHtml(value) {
    return String(value)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;');
  }

  function renderAlerts(alerts) {
    if (!alertList) return;
    if (!alerts.length) {
      alertList.innerHTML = '<div class="pulse-empty-state">No live alerts yet. Your newsroom feed is ready for the next update.</div>';
      updateBadge();
      return;
    }

    alertList.innerHTML = alerts.map((alert) => `
      <article class="pulse-alert-card" data-alert-id="${escapeHtml(alert.id)}">
        <div class="pulse-alert-top">
          <span class="pulse-alert-label">${escapeHtml(alert.label || alert.category || 'Update')}</span>
          <span class="pulse-alert-time">${escapeHtml(formatTime(alert.time))}</span>
        </div>
        <h4 class="pulse-alert-headline">${escapeHtml(alert.headline || '')}</h4>
        <p class="pulse-alert-summary">${escapeHtml(alert.summary || '')}</p>
        <div class="pulse-alert-actions">
          ${alert.transcript_id ? `<button class="pulse-alert-open" type="button" data-transcript-id="${escapeHtml(alert.transcript_id)}">${escapeHtml(alert.action_text || 'Open transcript')}</button>` : ''}
          <button class="pulse-alert-mark" type="button" data-mark-read>Mark as read</button>
        </div>
      </article>
    `).join('');

    alertList.querySelectorAll('[data-transcript-id]').forEach((button) => {
      button.addEventListener('click', () => openTranscript(button.getAttribute('data-transcript-id')));
    });

    alertList.querySelectorAll('[data-mark-read]').forEach((button) => {
      button.addEventListener('click', () => {
        localStorage.setItem(STORAGE_LAST_OPEN, String(Date.now()));
        updateBadge();
        renderAlerts(state.alerts);
      });
    });

    updateBadge();
  }

  function renderAccount() {
    if (!accountList) return;
    if (!state.account.length) {
      accountList.innerHTML = '<div class="pulse-empty-state">No account activity yet.</div>';
      updateBadge();
      return;
    }

    accountList.innerHTML = state.account.map((item) => `
      <a class="pulse-account-card ${item.is_read ? '' : 'is-unread'}" href="${escapeHtml(item.url)}">
        <div class="pulse-account-avatar" style="background:${escapeHtml(item.actor_avatar || '#c8102e')}">${escapeHtml(initials(item.actor_name))}</div>
        <div class="pulse-account-copy">
          <div class="pulse-account-message">${item.message}</div>
          <div class="pulse-account-time">${escapeHtml(item.time_label)}</div>
        </div>
      </a>
    `).join('');

    updateBadge();
  }

  async function fetchAlerts() {
    if (!alertList) return [];
    try {
      const response = await fetch(`alerts-feed.php?page=${encodeURIComponent(pageId)}`, { cache: 'no-store' });
      if (!response.ok) throw new Error('Unable to load alerts.');
      const data = await response.json();
      state.alerts = data.alerts || [];
      renderAlerts(state.alerts);
      maybeNotify(state.alerts);
      return state.alerts;
    } catch (error) {
      alertList.innerHTML = '<div class="pulse-empty-state">Pulse Alerts could not load right now. Refresh the page and try again.</div>';
      state.alerts = [];
      updateBadge();
      return [];
    }
  }

  async function fetchAccountNotifications(markRead = false) {
    if (!accountList) return;
    try {
      const res = await fetch('notifications-php/api.php?action=list', { credentials: 'same-origin', cache: 'no-store' });
      const data = await res.json();
      if (!data || data.notLoggedIn) {
        state.account = [];
        state.accountUnread = 0;
        accountList.innerHTML = '<div class="pulse-empty-state">Sign in to see account notifications.</div>';
        updateBadge();
        return;
      }
      state.account = Array.isArray(data.notifications) ? data.notifications : [];
      state.accountUnread = Number(data.unread || 0);
      renderAccount();

      if (markRead && state.accountUnread > 0) {
        await fetch('notifications-php/api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          credentials: 'same-origin',
          body: 'action=mark_all_read'
        });
        state.accountUnread = 0;
        state.account = state.account.map((item) => ({ ...item, is_read: true }));
        renderAccount();
      }
    } catch (error) {
      accountList.innerHTML = '<div class="pulse-empty-state">Account notifications could not load right now.</div>';
    }
  }

  async function refreshAll(options = {}) {
    if (document.visibilityState === 'hidden' && !options.force) return;
    await Promise.all([
      fetchAlerts(),
      fetchAccountNotifications(options.markAccountRead === true)
    ]);
  }

  function maybeNotify(alerts) {
    if (!('Notification' in window)) return;
    if (Notification.permission !== 'granted') return;
    if (localStorage.getItem(STORAGE_ALLOW_BROWSER) !== 'true') return;
    const latest = alerts[0];
    if (!latest) return;
    const latestTime = new Date(latest.time).getTime();
    const notifiedAt = Number(localStorage.getItem(STORAGE_LAST_ALERT) || 0);
    if (latestTime <= notifiedAt) return;

    const notification = new Notification('UrbanPulse Alert', {
      body: latest.headline || 'New UrbanPulse alert available.',
      icon: 'IMAGES/UrbanPulse.png',
      badge: 'IMAGES/UrbanPulse.png'
    });

    notification.onclick = () => {
      window.focus();
      if (latest.transcript_id) openTranscript(latest.transcript_id);
      else openDrawer();
    };

    localStorage.setItem(STORAGE_LAST_ALERT, String(latestTime));
  }

  function setActiveTab(name) {
    state.activeTab = name === 'account' ? 'account' : 'alerts';
    tabButtons.forEach((button) => {
      const active = button.getAttribute('data-pulse-tab') === state.activeTab;
      button.classList.toggle('is-active', active);
      button.setAttribute('aria-selected', active ? 'true' : 'false');
    });
    tabPanels.forEach((panel) => {
      const active = panel.getAttribute('data-pulse-panel') === state.activeTab;
      panel.classList.toggle('is-active', active);
      panel.hidden = !active;
    });
    if (state.activeTab === 'account') {
      fetchAccountNotifications(true);
    }
  }

  function openDrawer() {
    if (!drawer || !overlay) return;
    drawer.hidden = false;
    overlay.hidden = false;
    requestAnimationFrame(() => drawer.classList.add('is-open'));
    drawer.setAttribute('aria-hidden', 'false');
    document.body.classList.add('pulse-open');
    localStorage.setItem(STORAGE_LAST_OPEN, String(Date.now()));
    setActiveTab(state.activeTab);
    refreshAll({ force: true, markAccountRead: state.activeTab === 'account' });
  }

  function closeDrawer() {
    if (!drawer || !overlay) return;
    drawer.classList.remove('is-open');
    drawer.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('pulse-open');
    setTimeout(() => {
      if (!drawer.classList.contains('is-open')) drawer.hidden = true;
      if (!transcriptModal || transcriptModal.hidden) overlay.hidden = true;
    }, 280);
  }

  function openTranscript(id) {
    if (!id || !transcriptModal || !transcriptContent || !overlay) return;
    transcriptModal.hidden = false;
    overlay.hidden = false;
    transcriptModal.setAttribute('aria-hidden', 'false');
    transcriptContent.innerHTML = '<div class="pulse-transcript-loading">Loading transcript lens...</div>';
    fetch(`transcript-feed.php?id=${encodeURIComponent(id)}`, { cache: 'no-store' })
      .then((response) => {
        if (!response.ok) throw new Error('Transcript not found');
        return response.json();
      })
      .then((data) => {
        transcriptContent.innerHTML = renderTranscript(data);
        localStorage.setItem(STORAGE_LAST_OPEN, String(Date.now()));
        updateBadge();
      })
      .catch(() => {
        transcriptContent.innerHTML = '<div class="pulse-empty-state">That transcript lens is not available right now.</div>';
      });
  }

  function closeTranscript() {
    if (!transcriptModal || !overlay) return;
    transcriptModal.hidden = true;
    transcriptModal.setAttribute('aria-hidden', 'true');
    if (!drawer || drawer.hidden) overlay.hidden = true;
  }

  function renderTranscript(data) {
    const blocks = Array.isArray(data.transcript) ? data.transcript : [];
    const signals = Array.isArray(data.signals) ? data.signals : [];
    return `
      <div class="pulse-transcript-eyebrow">${escapeHtml(data.eyebrow || 'Transcript Lens')}</div>
      <h3 class="pulse-transcript-title">${escapeHtml(data.headline || 'UrbanPulse Transcript')}</h3>
      <p class="pulse-transcript-deck">${escapeHtml(data.deck || '')}</p>
      <div class="pulse-transcript-meta">
        <span>${escapeHtml(data.author || 'UrbanPulse Desk')}</span>
        <span>${escapeHtml(data.published || '')}</span>
        <span>${escapeHtml(data.duration || '')}</span>
      </div>
      <div class="pulse-transcript-grid">
        <div class="pulse-transcript-main">
          <div class="pulse-transcript-summary">
            <div class="pulse-transcript-section-title">Scene setter</div>
            <p>${escapeHtml(data.summary || '')}</p>
          </div>
          <div class="pulse-transcript-blocks" style="margin-top: 1rem; display: grid; gap: 0.9rem;">
            ${blocks.map((block) => `<article class="pulse-transcript-block"><div class="pulse-transcript-stamp">${escapeHtml(block.stamp || '')}</div><h4>${escapeHtml(block.title || '')}</h4><p>${escapeHtml(block.text || '')}</p></article>`).join('')}
          </div>
        </div>
        <aside class="pulse-transcript-side">
          <div class="pulse-transcript-section-title">Newsroom signals</div>
          <div class="pulse-signal-list">
            ${signals.map((signal) => `<div class="pulse-signal-card"><strong>${escapeHtml(signal.label || '')}</strong><span>${escapeHtml(signal.text || '')}</span></div>`).join('')}
          </div>
        </aside>
      </div>`;
  }

  if (bellButton) {
    bellButton.addEventListener('click', () => {
      if (drawer && !drawer.hidden && drawer.classList.contains('is-open')) closeDrawer();
      else openDrawer();
    });
  }

  document.querySelectorAll('[data-close-pulse]').forEach((button) => button.addEventListener('click', closeDrawer));
  document.querySelectorAll('[data-close-transcript]').forEach((button) => button.addEventListener('click', closeTranscript));
  overlay?.addEventListener('click', () => {
    closeTranscript();
    closeDrawer();
  });

  tabButtons.forEach((button) => {
    button.addEventListener('click', () => setActiveTab(button.getAttribute('data-pulse-tab')));
  });

  enableButton?.addEventListener('click', async () => {
    if (!('Notification' in window)) return;
    const permission = await Notification.requestPermission();
    localStorage.setItem(STORAGE_ALLOW_BROWSER, permission === 'granted' ? 'true' : 'false');
    setPermissionText();
  });

  document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'visible') refreshAll({ force: true });
  });

  document.addEventListener('DOMContentLoaded', () => {
    setPermissionText();
    setActiveTab('alerts');
    window.setTimeout(() => refreshAll({ force: true }), 500);
    state.pollTimer = window.setInterval(() => refreshAll({ force: false }), 60000);
  });
})();

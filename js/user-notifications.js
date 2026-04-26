(() => {
  'use strict';
  if (window.UPNotificationsLoaded) return;
  window.UPNotificationsLoaded = true;

  const state = { open: false, unread: 0, items: [] };

  function hasLoggedInUI() {
    return !!document.querySelector('.nav-avatar, .nav-logout-btn, .header-user-profile, a[href="php/logout.php"]');
  }

  function targetContainer() {
    return document.querySelector('.header-right')
      || document.querySelector('.header-main .header-container > div[style*="display:flex"]');
  }

  function initials(name) {
    return (name || '?').trim().split(/\s+/).map(part => part[0]).join('').slice(0, 2).toUpperCase();
  }

  function ensureUI() {
    if (!hasLoggedInUI()) return null;
    const target = targetContainer();
    if (!target) return null;
    let host = document.getElementById('userNotifyHost');
    if (host) return host;

    host = document.createElement('div');
    host.id = 'userNotifyHost';
    host.className = 'user-notify-host';
    host.innerHTML = `
      <button id="userNotifyToggle" class="user-notify-trigger" type="button" aria-label="Open account notifications" aria-expanded="false">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"></path>
          <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
        <span id="userNotifyBadge" class="user-notify-badge" hidden>0</span>
      </button>
      <div id="userNotifyPanel" class="user-notify-panel" hidden>
        <div class="user-notify-header">
          <div>
            <div class="user-notify-eyebrow">Account</div>
            <div class="user-notify-title">Notifications</div>
          </div>
          <button id="userNotifyClose" class="user-notify-close" type="button" aria-label="Close notifications">✕</button>
        </div>
        <div id="userNotifyList" class="user-notify-list"></div>
      </div>
    `;

    const before = target.querySelector('.theme-toggle, .nav-divider');
    if (before) target.insertBefore(host, before);
    else target.prepend(host);

    const toggle = host.querySelector('#userNotifyToggle');
    const close = host.querySelector('#userNotifyClose');
    const panel = host.querySelector('#userNotifyPanel');

    toggle.addEventListener('click', async (event) => {
      event.stopPropagation();
      state.open = !state.open;
      panel.hidden = !state.open;
      toggle.setAttribute('aria-expanded', state.open ? 'true' : 'false');
      if (state.open) {
        await refresh(true);
      }
    });

    close.addEventListener('click', () => {
      state.open = false;
      panel.hidden = true;
      toggle.setAttribute('aria-expanded', 'false');
    });

    document.addEventListener('click', (event) => {
      if (!host.contains(event.target)) {
        state.open = false;
        panel.hidden = true;
        toggle.setAttribute('aria-expanded', 'false');
      }
    });

    return host;
  }

  function render() {
    const host = ensureUI();
    if (!host) return;

    const badge = host.querySelector('#userNotifyBadge');
    const list = host.querySelector('#userNotifyList');

    badge.textContent = state.unread > 99 ? '99+' : String(state.unread);
    badge.hidden = state.unread < 1;

    if (!state.items.length) {
      list.innerHTML = '<div class="user-notify-empty">No new activity yet.</div>';
      return;
    }

    list.innerHTML = state.items.map(item => `
      <a class="user-notify-item ${item.is_read ? '' : 'unread'}" href="${item.url}">
        <div class="user-notify-avatar" style="background:${item.actor_avatar || '#c8102e'}">${initials(item.actor_name)}</div>
        <div class="user-notify-copy">
          <div class="user-notify-message">${item.message}</div>
          <div class="user-notify-time">${item.time_label}</div>
        </div>
      </a>
    `).join('');
  }

  async function refresh(markRead = false) {
    const host = ensureUI();
    if (!host) return;
    try {
      const res = await fetch('notifications-php/api.php?action=list', { credentials: 'same-origin' });
      const data = await res.json();
      if (!data || data.notLoggedIn) return;
      state.items = Array.isArray(data.notifications) ? data.notifications : [];
      state.unread = Number(data.unread || 0);
      render();
      if (markRead && state.unread > 0) {
        await fetch('notifications-php/api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          credentials: 'same-origin',
          body: 'action=mark_all_read'
        });
        state.unread = 0;
        state.items = state.items.map(item => ({ ...item, is_read: true }));
        render();
      }
    } catch (error) {
      console.error('Notification load failed:', error);
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const host = ensureUI();
    if (!host) return;
    refresh(false);
    window.setInterval(() => refresh(false), 30000);
  });
})();

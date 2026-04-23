(() => {
  'use strict';

  const html = `
    <div class="up-modal-overlay" id="upModalOverlay" hidden></div>
    <div class="up-modal" id="upModal" hidden aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="upModalTitle">
      <div class="up-modal-card">
        <div class="up-modal-topline"></div>
        <button class="up-modal-close" type="button" id="upModalClose" aria-label="Close dialog">✕</button>
        <div class="up-modal-badge" id="upModalBadge">UrbanPulse</div>
        <h2 class="up-modal-title" id="upModalTitle">Confirm action</h2>
        <p class="up-modal-text" id="upModalText">Please confirm this action.</p>
        <div class="up-modal-actions">
          <button class="up-modal-btn up-modal-btn-secondary" type="button" id="upModalCancel">Cancel</button>
          <button class="up-modal-btn up-modal-btn-primary" type="button" id="upModalConfirm">Continue</button>
        </div>
      </div>
    </div>
  `;

  function ensureModal() {
    if (document.getElementById('upModal')) return;
    document.body.insertAdjacentHTML('beforeend', html);
  }

  function getModalEls() {
    ensureModal();
    return {
      overlay: document.getElementById('upModalOverlay'),
      modal: document.getElementById('upModal'),
      close: document.getElementById('upModalClose'),
      cancel: document.getElementById('upModalCancel'),
      confirm: document.getElementById('upModalConfirm'),
      title: document.getElementById('upModalTitle'),
      text: document.getElementById('upModalText'),
      badge: document.getElementById('upModalBadge')
    };
  }

  let cleanup = null;

  function closeModal() {
    const els = getModalEls();
    els.overlay.hidden = true;
    els.modal.hidden = true;
    els.modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('up-modal-open');
    if (typeof cleanup === 'function') cleanup();
    cleanup = null;
  }

  function wireClose(handler) {
    const els = getModalEls();
    const onKeydown = (event) => {
      if (event.key === 'Escape') handler();
    };
    els.overlay.onclick = handler;
    els.close.onclick = handler;
    els.cancel.onclick = handler;
    document.addEventListener('keydown', onKeydown);
    cleanup = () => {
      document.removeEventListener('keydown', onKeydown);
      els.overlay.onclick = null;
      els.close.onclick = null;
      els.cancel.onclick = null;
      els.confirm.onclick = null;
    };
  }

  function openModal({ title, text, badge = 'UrbanPulse', confirmLabel = 'Continue', cancelLabel = 'Cancel', tone = 'primary', onConfirm, onCancel }) {
    const els = getModalEls();
    els.title.textContent = title || 'Confirm action';
    els.text.textContent = text || 'Please confirm this action.';
    els.badge.textContent = badge;
    els.confirm.textContent = confirmLabel;
    els.cancel.textContent = cancelLabel;
    els.confirm.classList.toggle('up-modal-btn-danger', tone === 'danger');
    els.confirm.classList.toggle('up-modal-btn-primary', tone !== 'danger');
    els.overlay.hidden = false;
    els.modal.hidden = false;
    els.modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('up-modal-open');
    wireClose(() => {
      closeModal();
      if (typeof onCancel === 'function') onCancel();
    });
    els.confirm.onclick = () => {
      const fn = onConfirm;
      closeModal();
      if (typeof fn === 'function') fn();
    };
    window.requestAnimationFrame(() => els.confirm.focus());
  }

  function alertModal({ title, text, badge = 'UrbanPulse', confirmLabel = 'Got it', tone = 'primary', onConfirm }) {
    openModal({ title, text, badge, confirmLabel, cancelLabel: 'Close', tone, onConfirm });
  }

  function setupLogoutConfirmation() {
    document.querySelectorAll('a[href="php/logout.php"], a[href$="/php/logout.php"]').forEach((link) => {
      if (link.dataset.upBound === '1') return;
      link.dataset.upBound = '1';
      link.addEventListener('click', (event) => {
        event.preventDefault();
        const destination = link.getAttribute('href') || 'php/logout.php';
        openModal({
          title: 'Log out of UrbanPulse?',
          text: 'You are about to sign out of your account on this device.',
          badge: 'Account',
          confirmLabel: 'Log out',
          cancelLabel: 'Stay here',
          tone: 'danger',
          onConfirm: () => { window.location.href = destination + (destination.includes('?') ? '&' : '?') + 'confirmed=1'; }
        });
      });
    });
  }

  function setupArticleSubmitConfirmation() {
    document.querySelectorAll('form[data-confirm-submit="article"]').forEach((form) => {
      if (form.dataset.upSubmitBound === '1') return;
      form.dataset.upSubmitBound = '1';

      const submitButtons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
      submitButtons.forEach((button) => {
        if (button.dataset.upSubmitButtonBound === '1') return;
        button.dataset.upSubmitButtonBound = '1';

        button.addEventListener('click', (event) => {
          if (form.dataset.upConfirmed === '1') {
            form.dataset.upConfirmed = '0';
            return;
          }

          event.preventDefault();
          openModal({
            title: 'Submit article for review?',
            text: 'Your story will be sent to the editorial team for checking and approval.',
            badge: 'Editorial Desk',
            confirmLabel: 'Submit article',
            cancelLabel: 'Keep editing',
            tone: 'primary',
            onConfirm: () => {
              form.dataset.upConfirmed = '1';
              if (typeof form.requestSubmit === 'function') {
                form.requestSubmit(button);
              } else {
                form.submit();
              }
            }
          });
        });
      });
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    ensureModal();
    setupLogoutConfirmation();
    setupArticleSubmitConfirmation();
  });

  window.UrbanPulseUI = {
    openModal,
    alert: alertModal,
    close: closeModal,
    setupLogoutConfirmation,
    setupArticleSubmitConfirmation
  };
})();

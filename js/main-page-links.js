(() => {
  'use strict';
  const interactive = 'a, button, input, select, textarea, label, summary, [role="button"]';
  const go = url => { if (url && url !== '#') window.location.href = url; };
  document.addEventListener('click', (e) => { const card = e.target.closest('[data-article-url]'); if (!card || e.target.closest(interactive)) return; go(card.getAttribute('data-article-url')); });
  document.addEventListener('keydown', (e) => { const card = e.target.closest('[data-article-url]'); if (!card || (e.key !== 'Enter' && e.key !== ' ')) return; if (e.target.closest(interactive) && e.target !== card) return; e.preventDefault(); go(card.getAttribute('data-article-url')); });
  document.querySelectorAll('[data-article-url]').forEach(card => { if (card.tabIndex < 0) card.tabIndex = 0; if (!card.getAttribute('role')) card.setAttribute('role','link'); });
})();

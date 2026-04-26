/* ============================================================
   js/filter.js — UrbanPulse shared page filters
   Works across Home, Technology, Sports, Entertainment, World News
   ============================================================ */

(() => {
  'use strict';

  const categorySelect = document.getElementById('categoryFilter');
  const dateSelect = document.getElementById('dateFilter');
  if (!categorySelect || !dateSelect) return;

  const ITEM_SELECTOR = '.filter-item, .news-item';
  const SECTION_SELECTOR = '[data-filter-section]';
  const filterEmpty = document.getElementById('filterEmpty');
  const filterResults = document.getElementById('filterResults');
  let toastTimer;


  const items = Array.from(document.querySelectorAll(ITEM_SELECTOR));
  if (!items.length) return;

  items.forEach((item) => {
    const wrapper = getFilterWrapper(item);
    const computed = window.getComputedStyle(wrapper).display;
    item.dataset.originalDisplay = computed && computed !== 'none' ? computed : '';
  });

  function getDateBounds() {
    const now = new Date();
    const startOfToday = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    const startOfWeek = new Date(startOfToday);
    startOfWeek.setDate(startOfToday.getDate() - startOfToday.getDay());
    const startOfMonth = new Date(now.getFullYear(), now.getMonth(), 1);
    return { startOfToday, startOfWeek, startOfMonth };
  }

  function matchesDate(itemDate, activeDate, bounds) {
    if (activeDate === 'all') return true;
    if (!itemDate) return false;
    const artDate = new Date(itemDate);
    if (Number.isNaN(artDate.getTime())) return false;
    if (activeDate === 'today') return artDate >= bounds.startOfToday;
    if (activeDate === 'this-week') return artDate >= bounds.startOfWeek;
    if (activeDate === 'this-month') return artDate >= bounds.startOfMonth;
    return true;
  }

  function setItemVisibility(item, show) {
    const wrapper = getFilterWrapper(item);
    const displayValue = item.dataset.originalDisplay || '';

    if (show) {
      wrapper.style.display = displayValue;
      wrapper.classList.remove('filter-hidden');
      wrapper.classList.add('filter-visible');
      item.classList.remove('filter-hidden');
      item.classList.add('filter-visible');
      return;
    }

    wrapper.classList.add('filter-hidden');
    wrapper.classList.remove('filter-visible');
    item.classList.add('filter-hidden');
    item.classList.remove('filter-visible');
    window.setTimeout(() => {
      if (wrapper.classList.contains('filter-hidden')) wrapper.style.display = 'none';
    }, 220);
  }

  function refreshSectionVisibility() {
    document.querySelectorAll(SECTION_SELECTOR).forEach((section) => {
      const hasVisibleItems = Array.from(section.querySelectorAll(ITEM_SELECTOR)).some((item) => getFilterWrapper(item).style.display !== 'none');
      section.style.display = hasVisibleItems ? '' : 'none';
    });
  }

  function updateSelectState(select, value) {
    select.classList.toggle('filter-active', value !== 'all');
  }

  function showFilterToast(count, activeCategory, activeDate) {
    let toast = document.getElementById('filterToast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'filterToast';
      document.body.appendChild(toast);
    }

    clearTimeout(toastTimer);

    if (activeCategory === 'all' && activeDate === 'all') {
      toast.classList.remove('ft-show');
      return;
    }

    const catLabel = categorySelect.options[categorySelect.selectedIndex]?.text || 'Selected category';
    const dateLabel = dateSelect.options[dateSelect.selectedIndex]?.text || 'Selected date';
    const parts = [];
    if (activeCategory !== 'all') parts.push(`<strong>${catLabel}</strong>`);
    if (activeDate !== 'all') parts.push(`<strong>${dateLabel}</strong>`);

    toast.innerHTML = count > 0
      ? `${count} article${count !== 1 ? 's' : ''} — ${parts.join(' · ')}`
      : `No articles match ${parts.join(' + ')}`;

    toast.classList.toggle('ft-empty', count === 0);
    toast.classList.add('ft-show');
    toastTimer = window.setTimeout(() => toast.classList.remove('ft-show'), 3200);
  }

  function updateHeadlineRanks() {
    let rank = 1;
    document.querySelectorAll('#headlineList .headline-card').forEach((card) => {
      if (card.style.display === 'none') return;
      const badge = card.querySelector('.headline-rank');
      if (badge) badge.textContent = String(rank++).padStart(2, '0');
    });
  }

  function getFilterWrapper(item) {
    if (item.matches('a')) return item;
    const anchorWrapper = item.closest('a.card-link');
    if (anchorWrapper && anchorWrapper.contains(item)) return anchorWrapper;
    return item;
  }

  function runFilter() {

    const activeCategory = categorySelect.value || 'all';
    const activeDate = dateSelect.value || 'all';
    const bounds = getDateBounds();
    const filterActive = activeCategory !== 'all' || activeDate !== 'all';
    let visibleCount = 0;

    items.forEach((item) => {
      const itemCategory = String(item.dataset.category || '').trim().toLowerCase();
      const itemDate = String(item.dataset.date || '').trim();
      const categoryMatch = activeCategory === 'all' || itemCategory === activeCategory;
      const dateMatch = matchesDate(itemDate, activeDate, bounds);
      const show = categoryMatch && dateMatch;
      setItemVisibility(item, show);
      if (show) {
        visibleCount += 1;
      }
    });

    refreshSectionVisibility();

    updateHeadlineRanks();

    if (filterResults) {
      filterResults.textContent = filterActive
        ? `${visibleCount} article${visibleCount !== 1 ? 's' : ''}`
        : '';
    }

    if (filterEmpty) {
      filterEmpty.classList.toggle('is-visible', visibleCount === 0 && filterActive);
    }

    updateSelectState(categorySelect, activeCategory);
    updateSelectState(dateSelect, activeDate);
    showFilterToast(visibleCount, activeCategory, activeDate);
  }

  categorySelect.addEventListener('change', runFilter);
  dateSelect.addEventListener('change', runFilter);
  runFilter();

  const style = document.createElement('style');
  style.textContent = `
    .filter-hidden { opacity: 0 !important; transform: scale(0.98) !important; pointer-events: none; }
    .filter-visible { opacity: 1; transform: scale(1); }
    .filter-item, .news-item { transition: opacity 0.22s ease, transform 0.22s ease; }
    .tools-select.filter-active, .filter-inner select.filter-active {
      border-color: var(--color-secondary, #c8102e) !important;
      background: #fff5f6 !important;
      color: var(--color-secondary, #c8102e) !important;
      font-weight: 700 !important;
    }
    #filterToast {
      position: fixed;
      left: 50%;
      bottom: 1.25rem;
      transform: translateX(-50%) translateY(80px);
      background: var(--color-primary, #1a1a1a);
      color: #fff;
      padding: 0.7rem 1.15rem;
      border-radius: 999px;
      font-size: 0.82rem;
      box-shadow: 0 10px 30px rgba(0,0,0,0.22);
      opacity: 0;
      transition: transform 0.32s cubic-bezier(0.16,1,0.3,1), opacity 0.25s ease;
      z-index: 9999;
      pointer-events: none;
      white-space: nowrap;
      border-left: 3px solid var(--color-secondary, #c8102e);
    }
    #filterToast.ft-show { opacity: 1; transform: translateX(-50%) translateY(0); }
    #filterToast.ft-empty { background: #7f1d1d; border-color: #fca5a5; }
    #filterToast strong { color: var(--color-accent, #d4af37); }
  `;
  document.head.appendChild(style);
})();

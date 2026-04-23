(() => {
  'use strict';

  const searchInput = document.getElementById('articleSearch');
  const categoryFilter = document.getElementById('categoryFilter');
  const dateFilter = document.getElementById('dateFilter');
  const emptyState = document.getElementById('filterEmpty');
  const items = Array.from(document.querySelectorAll('.filter-item'));

  function normalizeDateFilter(value) {
    if (!value || value === 'all') return null;
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    if (value === 'today') return today;
    if (value === 'startWeek') {
      const start = new Date(today);
      start.setDate(today.getDate() - today.getDay());
      return start;
    }
    if (value === 'startMonth') return new Date(now.getFullYear(), now.getMonth(), 1);
    return null;
  }

  function applyFilters() {
    const q = (searchInput?.value || '').trim().toLowerCase();
    const cat = categoryFilter?.value || 'all';
    const minDate = normalizeDateFilter(dateFilter?.value || 'all');
    let visible = 0;

    items.forEach(item => {
      const itemCategory = item.dataset.category || 'all';
      const haystack = ((item.dataset.search || '') + ' ' + (item.textContent || '')).toLowerCase();
      const itemDate = item.dataset.date ? new Date(item.dataset.date) : null;

      const matchesSearch = !q || haystack.includes(q);
      const matchesCategory = cat === 'all' || itemCategory === cat;
      const matchesDate = !minDate || (itemDate && itemDate >= minDate);
      const show = matchesSearch && matchesCategory && matchesDate;

      item.style.display = show ? '' : 'none';
      item.classList.toggle('is-filter-hidden', !show);
      if (show) visible += 1;
    });

    document.querySelectorAll('[data-filter-section]').forEach(section => {
      const sectionItems = Array.from(section.querySelectorAll('.filter-item'));
      if (!sectionItems.length) return;
      const hasVisible = sectionItems.some(item => item.style.display !== 'none');
      section.style.display = hasVisible ? '' : 'none';
    });

    if (emptyState) {
      emptyState.style.display = visible ? 'none' : 'block';
      emptyState.classList.toggle('is-visible', !visible);
    }
  }

  document.querySelectorAll('[data-read-more]').forEach(button => {
    button.addEventListener('click', () => {
      const target = document.getElementById(button.dataset.readMore);
      if (!target) return;
      const expanded = button.getAttribute('aria-expanded') === 'true';
      target.hidden = expanded;
      button.setAttribute('aria-expanded', expanded ? 'false' : 'true');
      button.textContent = expanded ? 'Read more' : 'Read less';
    });
  });

  searchInput?.addEventListener('input', applyFilters);
  categoryFilter?.addEventListener('change', applyFilters);
  dateFilter?.addEventListener('change', applyFilters);

  applyFilters();
})();

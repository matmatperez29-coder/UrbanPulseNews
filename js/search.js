(() => {
  'use strict';

  const STATIC_ARTICLES = [
    { title:'The Transition to Agentic AI and Autonomous Systems', url:'article-ai-agentic-revolution.php', cat:'technology', kw:'AI agentic autonomous systems enterprise workflows governance Aris Thorne artificial intelligence', desc:'AI has shifted from simple chatbots to autonomous agents capable of executing complex workflows without human intervention.' },
    { title:'GPT-6 Early Beta: Users Report "Near-Human" Emotional Reasoning', url:'article-gpt6-beta.php', cat:'technology', kw:'GPT-6 OpenAI emotional intelligence reasoning Julian Vane beta', desc:'Early testers documented sophisticated emotional intelligence and nuanced ethical reasoning from GPT-6.' },
    { title:'Humanoid Robots Join Global Manufacturing Lines', url:'article-humanoid-robots.php', cat:'technology', kw:'humanoid robots manufacturing assembly factories Sarah Jenkins', desc:'Bipedal robots are entering factory floors and changing how industrial work is handled.' },
    { title:'Meta Shuts Down Messenger Desktop Website', url:'article-meta-messenger.php', cat:'technology', kw:'Meta Messenger desktop website Facebook Sharona Nicole Semilla', desc:'Meta pulls the plug on Messenger.com and redirects users back to Facebook.' },
    { title:'SpaceX Starship 5: First Orbital Fuel Transfer', url:'article-starship-fuel-transfer.php', cat:'technology', kw:'SpaceX Starship orbital fuel transfer Artemis lunar David Sutherland', desc:'Cryogenic fuel transfer between Starship vehicles marks a major step for deep-space missions.' },
    { title:'Rise of 6G and Terahertz Communication', url:'technology.php', cat:'technology', kw:'6G terahertz telecom networking standard terabit communications', desc:'Global telecom firms are pushing next-generation 6G standards and terahertz-speed connectivity.' },
    { title:'Quantum Materials: True 1D Electron Behavior', url:'article-quantum.php', cat:'technology', kw:'quantum materials one dimensional electrons superconductors Elena Costas', desc:'A breakthrough in quantum materials could reshape future superconducting technologies.' },
    { title:'Australia Launches Secure Sovereign AI Factory', url:'article-australia-ai.php', cat:'technology', kw:'Australia sovereign AI factory NVIDIA Cisco secure data center Marcus Thompson', desc:'Australia moves to process sensitive government AI workloads locally through a secure sovereign AI center.' },
    { title:'Infinix NOTE 60: Revolutionary Battery Tech', url:'article-infinix.php', cat:'technology', kw:'Infinix NOTE 60 solid-state battery smartphone Sam Chen', desc:'A new battery approach promises dramatically longer smartphone endurance.' },

    { title:'Philadelphia Eagles Triumph in Super Bowl LIX', url:'article-eagles-super-bowl.php', cat:'sports', kw:'Eagles Super Bowl Chiefs Jalen Hurts football NFL Marcus Thompson', desc:'The Eagles defeated the Chiefs 40–22 and denied Kansas City a historic three-peat.' },
    { title:'OKC Thunder Win First NBA Title in 46 Years', url:'article-okc-thunder.php', cat:'sports', kw:'OKC Thunder NBA Finals Pacers Shai Gilgeous-Alexander basketball Sarah Jenkins', desc:'The Thunder captured their first NBA title since 1979 after a dramatic Finals run.' },
    { title:'PSG Claims Maiden Champions League Trophy', url:'article-psg.php', cat:'sports', kw:'PSG Champions League Inter Milan Munich Luis Enrique Desire Doue soccer football James Pratt', desc:'PSG dismantled Inter Milan in the final to claim a historic Champions League title.' },
    { title:'Sinner and Świątek Rule Wimbledon 2025', url:'article-wimbledon.php', cat:'sports', kw:'Wimbledon Sinner Swiatek Alcaraz tennis Elena Costas', desc:'Wimbledon closed with standout title runs from Sinner and Świątek.' },
    { title:'Dodgers Repeat as World Series Champions', url:'article-dodgers.php', cat:'sports', kw:'Dodgers World Series Blue Jays MLB baseball David Sutherland', desc:'The Dodgers won back-to-back World Series titles in another dramatic postseason finish.' },

    { title:"Renaissance of Cinema: 2026's Boldest Directors", url:'article-cinema-renaissance.php', cat:'entertainment', kw:'cinema directors film festival 70mm AI narratives Elena Thorne movies', desc:'From AI narratives to 70mm film, the big screen is having a bold creative resurgence.' },
    { title:"AI Rapper 'AERO' Hits No.1 on Global Charts", url:'entertainment.php', cat:'entertainment', kw:'AI rapper AERO global charts streaming music authenticity', desc:'The AI-generated artist AERO continues to dominate global streaming charts.' },
    { title:'Vinyl Outsells Digital Downloads Third Year Running', url:'entertainment.php', cat:'entertainment', kw:'vinyl records digital downloads music Liam West', desc:'Physical vinyl continues to outperform digital downloads in music sales.' },
    { title:'Interactive Theatre Reimagines Shakespeare', url:'entertainment.php', cat:'entertainment', kw:'interactive theatre Shakespeare immersive stage drama', desc:'Immersive productions are bringing Shakespeare to life for new audiences.' },
    { title:'UrbanStream+ Announces 12 New Original Series', url:'entertainment.php', cat:'entertainment', kw:'UrbanStream streaming original series exclusives', desc:'The platform is expanding its content slate with a dozen new originals.' },

    { title:'Global Summit Targets Plastic-Free Oceans by 2040', url:'article-plastic-oceans.php', cat:'worldnews', kw:'plastic-free oceans Geneva Blue Horizon climate summit world leaders Julian Vane', desc:'World leaders are backing an ambitious plan to cut ocean plastic pollution worldwide.' },
    { title:'Sub-Orbital Satellites Bring Internet to the World', url:'worldnews.php', cat:'worldnews', kw:'satellite internet remote connectivity Sahara Amazon', desc:"New satellite systems are helping bring internet access to some of the world's most remote places." },
    { title:'ASEAN Digital Currency Framework Signed', url:'article-asean.php', cat:'worldnews', kw:'ASEAN digital currency Southeast Asia trade pact Aris Thorne', desc:'Ten Southeast Asian nations move forward with a shared digital currency framework.' },
    { title:'Mars Base Alpha: First Successful Greenhouse Harvest', url:'worldnews.php', cat:'worldnews', kw:'Mars Base Alpha greenhouse harvest colony science', desc:'Scientists reported a major milestone in sustainable off-world food production.' },
    { title:"Brussels Proposes EU 'Right to Disconnect' Law", url:'worldnews.php', cat:'worldnews', kw:'Brussels EU right to disconnect workers burnout emails', desc:'European lawmakers are pushing protections against after-hours work communication.' },
    { title:'Amazon Reforestation at Five-Year High in Brazil', url:'worldnews.php', cat:'worldnews', kw:'Amazon reforestation Brazil satellite carbon credits environment', desc:'Reforestation gains in Brazil signal a strong shift in Amazon recovery efforts.' }
  ];

  const CAT_LABELS = { technology:'Technology', sports:'Sports', entertainment:'Entertainment', worldnews:'World News' };
  const CAT_COLORS = { technology:'#0066cc', sports:'#ff6b35', entertainment:'#9b59b6', worldnews:'#27ae60' };
  const PLACEHOLDERS = {
    all: 'Search UrbanPulse news',
    technology: 'Search technology news',
    sports: 'Search sports news',
    entertainment: 'Search entertainment news',
    worldnews: 'Search world news'
  };

  function normalizeScope(value) {
    const v = String(value || '').trim().toLowerCase();
    return ['technology', 'sports', 'entertainment', 'worldnews'].includes(v) ? v : 'all';
  }

  function getPageScope() {
    const bodyScope = normalizeScope(document.body?.dataset?.page || '');
    if (bodyScope !== 'all') return bodyScope;
    const file = (window.location.pathname.split('/').pop() || '').toLowerCase();
    if (file === 'technology.php') return 'technology';
    if (file === 'sports.php') return 'sports';
    if (file === 'entertainment.php') return 'entertainment';
    if (file === 'worldnews.php') return 'worldnews';
    return 'all';
  }

  function escapeRegExp(value) {
    return String(value).replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
  }

  function hl(text, q) {
    if (!q) return text;
    const esc = escapeRegExp(q);
    return String(text).replace(
      new RegExp(`(${esc})`, 'gi'),
      '<mark style="background:rgba(200,16,46,0.13);color:#c8102e;font-weight:800;border-radius:2px;padding:0 1px">$1</mark>'
    );
  }

  function catBadge(cat) {
    if (!cat || !CAT_COLORS[cat]) return '';
    return `<span style="background:${CAT_COLORS[cat]};color:#fff;font-size:0.62rem;font-weight:800;letter-spacing:.8px;text-transform:uppercase;padding:.18rem .5rem;border-radius:999px;flex-shrink:0">${CAT_LABELS[cat]}</span>`;
  }

  function searchURL(q, scope = getPageScope()) {
    const params = new URLSearchParams();
    params.set('q', q.trim());
    if (scope && scope !== 'all') params.set('scope', scope);
    return `search.php?${params.toString()}`;
  }

  const pageScope = getPageScope();
  let dbLoaded = false;
  let dbPromise = null;
  let dbArticles = [];

  async function ensureArticlesLoaded(scope = pageScope) {
    if (dbLoaded) return dbArticles;
    if (dbPromise) return dbPromise;
    const url = scope === 'all' ? 'php/api-search.php?scope=all' : `php/api-search.php?scope=${encodeURIComponent(scope)}`;
    dbPromise = fetch(url, { cache: 'no-store' })
      .then((res) => res.ok ? res.json() : { success: false, articles: [] })
      .then((data) => {
        dbArticles = data && data.success && Array.isArray(data.articles) ? data.articles : [];
        dbLoaded = true;
        return dbArticles;
      })
      .catch(() => {
        dbArticles = [];
        dbLoaded = true;
        return dbArticles;
      });
    return dbPromise;
  }

  function dedupeArticles(items) {
    const seen = new Set();
    return items.filter((item) => {
      const key = `${item.url}::${item.title}`;
      if (seen.has(key)) return false;
      seen.add(key);
      return true;
    });
  }

  function getScopedArticles(scope = pageScope) {
    const normalized = normalizeScope(scope);
    const merged = dedupeArticles([...STATIC_ARTICLES, ...dbArticles]);
    return normalized === 'all' ? merged : merged.filter((item) => item.cat === normalized);
  }

  window.UP_SEARCH_HL = hl;
  window.UP_CAT_COLORS = CAT_COLORS;
  window.UP_CAT_LABELS = CAT_LABELS;
  window.UP_SEARCH_PAGE_SCOPE = pageScope;
  window.UP_SEARCH_URL = searchURL;
  window.UP_SEARCH_GET_INDEX = async (scope = pageScope) => {
    await ensureArticlesLoaded(scope);
    return getScopedArticles(scope);
  };

  const toggle = document.getElementById('searchToggle');
  const drop = document.getElementById('searchBarDrop');
  const box = document.getElementById('searchBox');
  const closeBtn = document.getElementById('searchClose');
  const resultsEl = document.getElementById('results');

  if (!toggle || !drop || !box) return;

  box.setAttribute('data-placeholder', PLACEHOLDERS[pageScope] || PLACEHOLDERS.all);

  function setHeaderHeight() {
    const breakingNews = document.querySelector('.BreakingNews');
    const headerMain = document.querySelector('.header-main');
    const bnRect = breakingNews ? breakingNews.getBoundingClientRect() : null;
    const navH = headerMain ? headerMain.getBoundingClientRect().height : 70;
    const bnVisible = bnRect && bnRect.bottom > 0 ? bnRect.bottom : 0;
    const totalH = bnVisible + navH;
    document.documentElement.style.setProperty('--header-h', totalH + 'px');
    drop.style.top = `${totalH}px`;
  }

  setHeaderHeight();
  window.addEventListener('resize', setHeaderHeight);
  window.addEventListener('scroll', setHeaderHeight, { passive: true });

  const overlay = document.createElement('div');
  overlay.className = 'search-overlay';
  document.body.appendChild(overlay);

  let isOpen = false;
  let focusIdx = -1;

  async function openSearch() {
    setHeaderHeight();
    isOpen = true;
    drop.classList.add('is-open');
    overlay.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
    drop.setAttribute('aria-hidden', 'false');
    await ensureArticlesLoaded(pageScope);
    requestAnimationFrame(() => requestAnimationFrame(() => box.focus()));
  }

  function closeSearch() {
    isOpen = false;
    drop.classList.remove('is-open');
    overlay.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    drop.setAttribute('aria-hidden', 'true');
    box.textContent = '';
    if (resultsEl) resultsEl.innerHTML = '';
    focusIdx = -1;
  }

  toggle.addEventListener('click', async (e) => {
    e.stopPropagation();
    if (isOpen) closeSearch();
    else await openSearch();
  });

  if (closeBtn) closeBtn.addEventListener('click', closeSearch);
  overlay.addEventListener('click', closeSearch);
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeSearch();
  });

  function getItems() {
    return [...(resultsEl?.querySelectorAll('.sbr-item') || [])];
  }

  function moveFocus(direction) {
    const items = getItems();
    if (!items.length) return;
    focusIdx = Math.max(0, Math.min(items.length - 1, focusIdx + direction));
    items.forEach((el, idx) => el.classList.toggle('sbr-focused', idx === focusIdx));
    items[focusIdx]?.scrollIntoView({ block: 'nearest' });
  }

  box.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowDown') {
      e.preventDefault();
      moveFocus(1);
    }
    if (e.key === 'ArrowUp') {
      e.preventDefault();
      moveFocus(-1);
    }
    if (e.key === 'Enter') {
      e.preventDefault();
      const focused = resultsEl?.querySelector('.sbr-focused');
      if (focused) {
        window.location.href = focused.href;
        return;
      }
      const q = (box.textContent || box.innerText || '').trim();
      if (q) window.location.href = searchURL(q, pageScope);
    }
  });

  box.addEventListener('keyup', function () {
    this.scrollLeft = this.scrollWidth;
  });

  let timer;
  box.addEventListener('input', async function () {
    const el = this;
    setTimeout(() => {
      el.scrollLeft = el.scrollWidth;
    }, 0);

    focusIdx = -1;
    clearTimeout(timer);
    const raw = (this.textContent || this.innerText || '').trim();
    const q = raw.toLowerCase();

    if (!q) {
      if (resultsEl) resultsEl.innerHTML = '';
      return;
    }

    await ensureArticlesLoaded(pageScope);
    timer = setTimeout(() => {
      const hits = getScopedArticles(pageScope)
        .filter((item) => [item.title, item.kw, item.desc].join(' ').toLowerCase().includes(q))
        .slice(0, 6);

      if (!resultsEl) return;

      if (!hits.length) {
        const scopeLabel = pageScope === 'all' ? 'news' : `${CAT_LABELS[pageScope].toLowerCase()} stories`;
        resultsEl.innerHTML = `<div class="sbr-empty"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>No ${scopeLabel} found for <strong>${raw}</strong>.</div>`;
        return;
      }

      const scopeLabel = pageScope === 'all' ? 'news results' : `${CAT_LABELS[pageScope].toLowerCase()} results`;
      resultsEl.innerHTML =
        `<div class="sbr-header">Quick Results <a href="${searchURL(raw, pageScope)}">View all →</a></div>` +
        hits.map((item) => `
          <a class="sbr-item" href="${item.url}">
            ${catBadge(item.cat)}
            <div class="sbr-text">
              <div class="sbr-title">${hl(item.title, raw)}</div>
              <div class="sbr-desc">${hl(item.desc, raw)}</div>
            </div>
            <svg class="sbr-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"></path></svg>
          </a>`).join('') +
        `<a class="sbr-viewall" href="${searchURL(raw, pageScope)}"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>See all ${scopeLabel} for "<strong>${raw}</strong>"</a>`;
    }, 100);
  });
})();

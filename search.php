<?php
$pageId = strtolower(trim((string)($_GET['scope'] ?? 'home')));
$allowedPages = ['home', 'technology', 'sports', 'entertainment', 'worldnews'];
if (!in_array($pageId, $allowedPages, true)) {
    $pageId = 'home';
}
require_once 'db.php';
require_once 'auth.php';
$currentUser = getCurrentUser();
$query = trim((string)($_GET['q'] ?? ''));
$scope = $pageId === 'home' ? 'all' : $pageId;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UrbanPulse | Search</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="navfooter.css" />
  <link rel="stylesheet" href="burgermenu.css" />
  <link rel="stylesheet" href="theme.css" />
  <link rel="stylesheet" href="pulse-features.css" />
  <link rel="icon" type="image/x-icon" href="IMAGES/UrbanPulse.png" />
  <style>
    body { background: var(--theme-body-bg, #fff); color: var(--color-text, #2d2d2d); }
    .search-results-wrap { max-width: 1100px; margin: 0 auto; padding: 1.5rem 1rem 3rem; }
    .search-page-hero { border: 1px solid rgba(26,26,26,.08); border-radius: 28px; padding: 1.4rem; background: linear-gradient(135deg, rgba(200,16,46,.04), rgba(212,175,55,.08)), var(--theme-card-bg, #fff); box-shadow: 0 20px 40px rgba(15,23,42,.06); }
    .search-page-eyebrow { font-size: .78rem; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; color: #c8102e; }
    .search-page-title { margin: .35rem 0 .4rem; font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 4vw, 2.7rem); }
    .search-page-sub { margin: 0; color: #667085; line-height: 1.7; }
    .search-page-form { display: flex; gap: .8rem; margin-top: 1.1rem; flex-wrap: wrap; }
    .search-page-input { flex: 1 1 320px; min-height: 52px; border-radius: 16px; border: 1px solid rgba(26,26,26,.12); padding: 0 1rem; font-size: 1rem; }
    .search-page-button { min-height: 52px; padding: 0 1.2rem; border: none; border-radius: 16px; background: #c8102e; color: #fff; font-weight: 700; }
    .search-meta { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin: 1.2rem 0 .9rem; flex-wrap: wrap; }
    .search-scope-badge { display: inline-flex; align-items: center; padding: .38rem .7rem; border-radius: 999px; background: rgba(200,16,46,.08); color: #c8102e; font-size: .78rem; font-weight: 800; letter-spacing: .06em; text-transform: uppercase; }
    .search-results-grid { display: grid; gap: 1rem; }
    .search-result-card { display: grid; gap: .65rem; padding: 1.1rem 1.15rem; border: 1px solid rgba(26,26,26,.08); border-radius: 22px; background: var(--theme-card-bg, #fff); box-shadow: 0 14px 30px rgba(15,23,42,.05); text-decoration: none; color: inherit; }
    .search-result-card:hover { transform: translateY(-1px); transition: transform .18s ease; }
    .search-result-top { display: flex; align-items: center; justify-content: space-between; gap: .8rem; }
    .search-result-cat { display: inline-flex; align-items: center; padding: .28rem .55rem; border-radius: 999px; background: rgba(200,16,46,.08); color: #c8102e; font-size: .72rem; font-weight: 800; letter-spacing: .07em; text-transform: uppercase; }
    .search-result-title { font-family: 'Playfair Display', serif; font-size: 1.15rem; font-weight: 800; color: var(--color-primary, #1a1a1a); }
    .search-result-desc { color: #667085; line-height: 1.7; }
    .search-empty { padding: 1.4rem; border-radius: 22px; border: 1px dashed rgba(26,26,26,.16); color: #667085; background: rgba(248,250,252,.9); }
    mark { background: rgba(200,16,46,.14); color: #c8102e; border-radius: 4px; padding: 0 .1rem; }
    html[data-theme='dark'] .search-page-sub,
    html[data-theme='dark'] .search-result-desc,
    html[data-theme='dark'] .search-empty { color: #a8b1bf; }
    html[data-theme='dark'] .search-page-hero,
    html[data-theme='dark'] .search-result-card { border-color: #2a313c; box-shadow: 0 18px 34px rgba(0,0,0,.22); }
    html[data-theme='dark'] .search-page-input { background: #151a22; border-color: #2a313c; color: #f4f7fb; }
    html[data-theme='dark'] .search-empty { background: #151a22; border-color: #2a313c; }
  </style>
</head>
<body data-page="<?php echo htmlspecialchars($pageId, ENT_QUOTES, 'UTF-8'); ?>">
  <?php require_once 'nav.php'; ?>

  <main class="search-results-wrap">
    <section class="search-page-hero">
      <div class="search-page-eyebrow">UrbanPulse Search</div>
      <h1 class="search-page-title">Find stories fast</h1>
      <p class="search-page-sub">Search across <?php echo $scope === 'all' ? 'all UrbanPulse news categories' : htmlspecialchars(ucfirst($scope), ENT_QUOTES, 'UTF-8') . ' stories'; ?> using the same shared search layout.</p>
      <form class="search-page-form" action="search.php" method="get">
        <input class="search-page-input" id="searchPageInput" type="search" name="q" value="<?php echo htmlspecialchars($query, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Search UrbanPulse stories">
        <?php if ($scope !== 'all'): ?>
          <input type="hidden" name="scope" value="<?php echo htmlspecialchars($scope, ENT_QUOTES, 'UTF-8'); ?>">
        <?php endif; ?>
        <button class="search-page-button" type="submit">Search</button>
      </form>
    </section>

    <div class="search-meta">
      <div id="searchPageCount">Loading results...</div>
      <span class="search-scope-badge"><?php echo $scope === 'all' ? 'All News' : htmlspecialchars($scope, ENT_QUOTES, 'UTF-8'); ?></span>
    </div>

    <section class="search-results-grid" id="searchPageResults"></section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="burger.js"></script>
  <script src="theme.js"></script>
  <script src="search.js"></script>
  <script src="pulse-features.js"></script>
<script src="article-interactions.js"></script>
  <script>
    (async () => {
      const params = new URLSearchParams(window.location.search);
      const query = (params.get('q') || '').trim();
      const scope = (params.get('scope') || '<?php echo $scope; ?>').trim() || 'all';
      const resultsEl = document.getElementById('searchPageResults');
      const countEl = document.getElementById('searchPageCount');
      const inputEl = document.getElementById('searchPageInput');
      if (inputEl && !inputEl.value && query) inputEl.value = query;

      const hl = window.UP_SEARCH_HL || ((text) => text);
      const catLabels = window.UP_CAT_LABELS || { technology: 'Technology', sports: 'Sports', entertainment: 'Entertainment', worldnews: 'World News' };
      const countLabel = (n) => `${n} result${n === 1 ? '' : 's'}${query ? ` for "${query}"` : ''}`;

      const allItems = window.UP_SEARCH_GET_INDEX ? await window.UP_SEARCH_GET_INDEX(scope) : [];
      const q = query.toLowerCase();
      const hits = allItems.filter((item) => {
        if (!q) return true;
        return [item.title, item.kw, item.desc].join(' ').toLowerCase().includes(q);
      });

      countEl.textContent = countLabel(hits.length);

      if (!hits.length) {
        resultsEl.innerHTML = `<div class="search-empty">No stories matched your search${query ? ` for <strong>${query}</strong>` : ''}. Try a different keyword.</div>`;
        return;
      }

      resultsEl.innerHTML = hits.map((item) => `
        <a class="search-result-card" href="${item.url}">
          <div class="search-result-top">
            <span class="search-result-cat">${catLabels[item.cat] || 'News'}</span>
          </div>
          <div class="search-result-title">${hl(item.title, query)}</div>
          <div class="search-result-desc">${hl(item.desc || '', query)}</div>
        </a>
      `).join('');
    })();
  </script>
</body>
</html>

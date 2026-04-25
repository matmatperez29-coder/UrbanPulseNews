<?php
if (!function_exists('renderApprovedCategorySection')) {
    function renderApprovedCategorySection(PDO $db, string $category, array $options = []): void {
        $allowed = ['technology', 'sports', 'entertainment', 'worldnews'];
        if (!in_array($category, $allowed, true)) {
            return;
        }

        $labels = [
            'technology' => 'Technology',
            'sports' => 'Sports',
            'entertainment' => 'Entertainment',
            'worldnews' => 'World News',
        ];
        $accents = [
            'technology' => '#0066cc',
            'sports' => '#ff6b35',
            'entertainment' => '#9b59b6',
            'worldnews' => '#27ae60',
        ];

        try {
            $stmt = $db->prepare("
                SELECT s.id, s.title, s.summary, s.image_url, s.submitted_at, u.name AS author_name
                FROM article_submissions s
                JOIN users u ON u.id = s.author_id
                WHERE s.status = 'approved' AND s.category = ?
                ORDER BY s.submitted_at DESC
            ");
            $stmt->execute([$category]);
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return;
        }

        if (!$articles) {
            return;
        }

        $sectionTitle = $options['title'] ?? ('Approved ' . $labels[$category] . ' articles');
        $sectionIntro = $options['intro'] ?? '';
        $eyebrow = $options['eyebrow'] ?? 'Editorial review';
        $accent = $accents[$category];
        $label = $labels[$category];
        ?>
        <section class="approved-feed-section" data-filter-section>
          <div class="approved-feed-header">
            <div>
              <div class="approved-feed-eyebrow"><?= htmlspecialchars($eyebrow) ?></div>
              <h2 class="approved-feed-title"><?= htmlspecialchars($sectionTitle) ?></h2>
              <?php if ($sectionIntro !== ''): ?>
              <p class="approved-feed-intro"><?= htmlspecialchars($sectionIntro) ?></p>
              <?php endif; ?>
            </div>
            <span class="approved-feed-badge" style="--approved-accent: <?= htmlspecialchars($accent) ?>;"><?= htmlspecialchars($label) ?></span>
          </div>

          <div class="approved-feed-grid">
            <?php foreach ($articles as $article):
                $url = 'view-article.php?id=' . (int)$article['id'];
                $dateAttr = date('Y-m-d', strtotime($article['submitted_at']));
                $dateLabel = date('F j, Y', strtotime($article['submitted_at']));
                $search = trim(($article['title'] ?? '') . ' ' . ($article['summary'] ?? '') . ' ' . ($article['author_name'] ?? '') . ' approved community article ' . $label);
                $hasImage = !empty($article['image_url']);
            ?>
            <article
              class="approved-feed-card filter-item card-linkable"
              data-article-url="<?= htmlspecialchars($url) ?>"
              data-category="<?= htmlspecialchars($category) ?>"
              data-date="<?= htmlspecialchars($dateAttr) ?>"
              data-search="<?= htmlspecialchars($search) ?>"
              style="--approved-accent: <?= htmlspecialchars($accent) ?>;"
            >
              <?php if ($hasImage): ?>
              <div class="approved-feed-image-wrap">
                <img class="approved-feed-image" src="<?= htmlspecialchars($article['image_url']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" loading="lazy">
                <span class="approved-feed-pill">Approved</span>
              </div>
              <?php else: ?>
              <div class="approved-feed-image-wrap approved-feed-image-wrap--placeholder">
                <span class="approved-feed-pill">Approved</span>
                <div class="approved-feed-placeholder-label"><?= htmlspecialchars($label) ?></div>
                <div class="approved-feed-placeholder-mark">UrbanPulse</div>
              </div>
              <?php endif; ?>

              <div class="approved-feed-content">
                <div class="approved-feed-meta-top">
                  <span class="approved-feed-category"><?= htmlspecialchars($label) ?></span>
                  <span class="approved-feed-date"><?= htmlspecialchars($dateLabel) ?></span>
                </div>
                <a class="approved-feed-link" href="<?= htmlspecialchars($url) ?>">
                  <h3 class="approved-feed-card-title"><?= htmlspecialchars($article['title']) ?></h3>
                </a>
                <p class="approved-feed-summary"><?= htmlspecialchars($article['summary']) ?></p>
                <div class="approved-feed-meta-bottom">
                  <span class="approved-feed-author"><?= htmlspecialchars($article['author_name']) ?></span>
                  <span class="approved-feed-open">Open article</span>
                </div>
              </div>
            </article>
            <?php endforeach; ?>
          </div>
        </section>
        <?php
    }
}

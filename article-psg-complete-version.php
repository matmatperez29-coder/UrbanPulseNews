<?php
require_once __DIR__ . '/php/db.php';
require_once 'php/php/auth.php';
$currentUser = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PSG finally looked like the complete version of themselves — UrbanPulse</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta property="og:title" content="PSG finally looked like the complete version of themselves">
  <meta property="og:description" content="The club’s most important final became a showcase for balance, conviction, and tactical maturity as PSG delivered a performance with almost no visible weakness.">
  <meta property="og:image" content="https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=900&amp;auto=format&amp;fit=crop">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navfooter.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/burgermenu.css">
  <link rel="stylesheet" href="css/article.css">
  <link rel="stylesheet" href="css/theme.css">
  <link rel="stylesheet" href="css/pulse-features.css">
  <link rel="icon" type="image/x-icon" href="IMAGES/UrbanPulse.png">
</head>
<body>

  <?php require_once 'nav.php'; ?>

  <main class="article-page">
    <div class="article-container">
      <div class="hero-news">
        <article>
          <p class="hero-subheadlines" style="color:#c8102e">SPORTS</p>
          <h1 class="hero-title">PSG finally looked like the complete version of themselves</h1>
          <div class="hero-meta">
            <strong>James Pratt</strong>
            <span>UrbanPulse.com</span>
            <span>May 31, 2025 · 11:40 PM CET</span>
          </div>

          <div class="share-bar" style="margin-bottom:1.5rem">
            <span class="share-label">Share:</span>
            <a class="share-btn fb" href="#" title="Share on Facebook">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg> Facebook
            </a>
            <a class="share-btn tw" href="#" title="Share on Twitter">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg> Tweet
            </a>
            <button class="share-btn copy">🔗 Copy Link</button>
            <span class="share-toast">Link copied!</span>
          </div>

          <div class="hero-image">
            <img src="images/sports/psg-complete-team-performance.jpg" alt="PSG finally looked like the complete version of themselves" loading="lazy">
          </div>
          <p class="hero-summary">The club’s most important final became a showcase for balance, conviction, and tactical maturity as PSG delivered a performance with almost no visible weakness.</p>
          <div class="hero-description">PSG have often entered huge European nights with talent to spare and questions to answer. Against Inter, those questions barely appeared. The final felt notable not only because Paris won, but because the side looked whole from beginning to end. Attack, midfield structure, recovery runs, pressing shape, and emotional control all lined up at once.<br><br>That completeness is what made the 5-0 scoreline believable rather than fluky. PSG did not need one individual rescue or one lucky passage of play. They looked comfortable imposing tempo, stretching the game, and punishing mistakes while still staying organized defensively.<br><br>It is easy to focus on goals in a final of that size, but the deeper takeaway was how few cracks the team showed. Inter were never allowed to drag the match into a chaotic or hopeful phase. PSG kept the performance clean, and in a game loaded with history, that clarity mattered.<br><br>For years, supporters imagined a version of Paris that could marry talent with total cohesion. On this night, they finally saw it. That is why the result felt bigger than a trophy count. It felt like a complete picture arriving all at once.</div>

          <div class="section-divider"></div>

          <div class="reactions">
            <div class="reactions-title">How do you feel about this article?</div>
            <div class="reaction-buttons"></div>
          </div>

          <div class="section-divider"></div>

          <div class="news-related">
            <h5 class="news-related-title">RELATED STORIES</h5>
            <a class="news-related-container" href="article-psg.php">
          <div class="news-related-image"><img src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=100&amp;auto=format&amp;fit=crop" alt="PSG Secure a Maiden Champions League and Complete the Treble"></div>
          <span class="news-related-headline">PSG Secure a Maiden Champions League and Complete the Treble</span>
        </a><a class="news-related-container" href="article-luis-enrique-breakthrough.php">
          <div class="news-related-image"><img src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=100&amp;auto=format&amp;fit=crop" alt="Luis Enrique finally led PSG to the European breakthrough they chased for years"></div>
          <span class="news-related-headline">Luis Enrique finally led PSG to the European breakthrough they chased for years</span>
        </a>
          </div>

          <div class="section-divider"></div>

          <div class="comments-section">
            <h3 class="comments-heading">
                Leave a Comment <span class="comment-count-badge" style="display:none">0</span>
            </h3>

            <?php if ($currentUser): ?>
                <form id="commentForm" class="comment-form">
                    <div class="form-group" style="margin-bottom: 0;">
                        <textarea id="commentText" placeholder="Share your thoughts, <?= htmlspecialchars(explode(' ', $currentUser['name'])[0]) ?>..." required></textarea>
                        <div id="charCount" class="comment-char-count">500 characters remaining</div>
                    </div>
                    <button type="submit" class="comment-submit" style="margin-top: 0.75rem;">Post Comment</button>
                </form>
            <?php else: ?>
                <div class="comment-form" style="text-align: center; padding: 2.5rem 1rem; background: var(--color-surface); border: 1px dashed var(--color-border);">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--color-text-muted)" stroke-width="1.5" style="margin-bottom: 1rem;">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <h4 style="font-family: var(--font-display); color: var(--color-primary); margin-bottom: 0.5rem;">Join the Conversation</h4>
                    <p style="font-size: 0.9rem; color: var(--color-text-light); margin-bottom: 1.5rem;">You must be logged in to leave a comment or react to this article.</p>
                    <a href="login.php" class="comment-submit" style="text-decoration: none; display: inline-block;">Log In or Register</a>
                </div>
            <?php endif; ?>

            <div id="commentList" class="comment-list"></div>
          </div>
        </article>
      </div>

      <aside class="sidebar">
        <h3 class="sidebar-heading">Recommended</h3>
        <div class="sidebar-stories">
          <div class="sidebar-story">
            <div class="sidebar-image"><img src="https://images.unsplash.com/photo-1566577739112-5180d4bf9390?w=300&amp;auto=format&amp;fit=crop" alt="Eagles Triumph in Super Bowl LIX" loading="lazy"></div>
            <div class="sidebar-story1">
              <a href="article-eagles-super-bowl.php"><h3 class="sidebar-headline">Eagles Triumph in Super Bowl LIX</h3></a>
              <span class="sidebar-category">Sports</span>
              <div class="sidebar-meta">
                <button class="sidebar-share">FB SHARE</button>
                <button class="sidebar-tweet">TWEET</button>
              </div>
            </div>
          </div><div class="sidebar-story">
            <div class="sidebar-image"><img src="https://images.unsplash.com/photo-1546519638405-a4d4e8df12b5?w=300&amp;auto=format&amp;fit=crop" alt="Thunder Strike Gold: OKC Wins Its First NBA Title Since 1979" loading="lazy"></div>
            <div class="sidebar-story1">
              <a href="article-okc-thunder.php"><h3 class="sidebar-headline">Thunder Strike Gold: OKC Wins Its First NBA Title Since 1979</h3></a>
              <span class="sidebar-category">Sports</span>
              <div class="sidebar-meta">
                <button class="sidebar-share">FB SHARE</button>
                <button class="sidebar-tweet">TWEET</button>
              </div>
            </div>
          </div><div class="sidebar-story">
            <div class="sidebar-image"><img src="https://images.unsplash.com/photo-1508344928928-7165b67de128?w=300&amp;auto=format&amp;fit=crop" alt="Dodger Dynasty: L.A. Clinches Back-to-Back Titles in an 11-Inning Classic" loading="lazy"></div>
            <div class="sidebar-story1">
              <a href="article-dodgers.php"><h3 class="sidebar-headline">Dodger Dynasty: L.A. Clinches Back-to-Back Titles in an 11-Inning Classic</h3></a>
              <span class="sidebar-category">Sports</span>
              <div class="sidebar-meta">
                <button class="sidebar-share">FB SHARE</button>
                <button class="sidebar-tweet">TWEET</button>
              </div>
            </div>
          </div>
        </div>

        <div class="roundup-section">
          <h2>Independent News</h2>
          <p>Independent journalism you can trust.</p>
          <form class="roundup-form" onsubmit="return false">
            <input type="email" placeholder="Your Email Address">
            <button type="submit">SIGN-UP</button>
          </form>
          <div class="roundup-help">Please enter a valid email address.</div>
          <div class="roundup-social">
            <p>or sign in with</p>
            <div class="social-row">
              <span class="soc-box">f</span>
              <span class="soc-box">G</span>
              <span class="soc-box">A</span>
              <span class="soc-box">M</span>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </main>

  <footer class="footer">
    <div class="footer-container">
      <div class="footer-content">
        <div class="footer-section">
          <h3>UrbanPulse</h3>
          <p>Independent journalism you can trust. Delivering truth in every story since 2026.</p>
          <div class="footer-social">
            <a href="#" aria-label="Facebook">FB</a>
            <a href="#" aria-label="Twitter">TW</a>
            <a href="#" aria-label="Instagram">IG</a>
            <a href="#" aria-label="Github">GH</a>
          </div>
        </div>
        <div class="footer-section"><h4>Categories</h4><ul><li><a href="technology.php">Technology</a></li><li><a href="sports.php">Sports</a></li><li><a href="entertainment.php">Entertainment</a></li><li><a href="worldnews.php">World News</a></li></ul></div>
        <div class="footer-section"><h4>Company</h4><ul><li><a href="about.php">About Us</a></li><li><a href="contact.php">Contact</a></li><li><a href="#">Careers</a></li><li><a href="#">Advertise</a></li></ul></div>
        <div class="footer-section"><h4>Pledge</h4><p>We, the UrbanPulse team, pledge to deliver news that keeps people informed, aware, and always updated.</p></div>
      </div>
      <div class="footer-bottom"><p>&copy; 2026 UrbanPulse News. All rights reserved.</p></div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/burger.js"></script>
  <script src="js/theme.js"></script>
  <script src="js/search.js"></script>
  <script src="js/pulse-features.js"></script>
<script src="js/article-js/interactions.js"></script>
  <script>
    const UP_IS_LOGGED_IN = <?php echo $currentUser ? 'true' : 'false'; ?>;
    const UP_IS_ADMIN     = <?php echo ($currentUser && $currentUser['role'] === 'admin') ? 'true' : 'false'; ?>;
    const UP_CURRENT_USER_ID = <?php echo $currentUser ? (int)$currentUser['id'] : 'null'; ?>;
</script>
  <script src="js/article-js/interactions.js"></script>
</body>
</html>

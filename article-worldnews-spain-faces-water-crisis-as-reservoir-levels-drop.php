<?php
require_once 'php/php/db.php';
require_once 'php/php/auth.php';
$currentUser = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spain Faces Water Crisis as Reservoir Levels Drop — UrbanPulse</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta property="og:title" content="Spain Faces Water Crisis as Reservoir Levels Drop">
  <meta property="og:description" content="Spain Faces Water Crisis as Reservoir Levels Drop highlights a developing economy story with wider consequences for communities, institutions, and the global conversation.">
  <meta property="og:image" content="https://media.cnn.com/api/v1/images/stellar/prod/230428112802-sau-reservoir-catalonia-spain.jpg?c=original">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navfooter.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/burgermenu.css">
  <link rel="stylesheet" href="css/article.css">
  <script>(function(){try{if(localStorage.getItem('up_theme')==='dark')document.documentElement.setAttribute('data-theme','dark')}catch(e){}})()</script>
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
          <p class="hero-subheadlines" style="color:#27ae60">WORLD NEWS</p>
          <h1 class="hero-title">Spain Faces Water Crisis as Reservoir Levels Drop</h1>
          <div class="hero-meta">
            <strong>Elena Sevillano</strong>
            <span>UrbanPulse.com</span>
            <span>March 06, 2026</span>
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
            <img src="https://media.cnn.com/api/v1/images/stellar/prod/230428112802-sau-reservoir-catalonia-spain.jpg?c=original" alt="Spain Faces Water Crisis as Reservoir Levels Drop" loading="lazy">
          </div>
          <p class="hero-summary">Spain Faces Water Crisis as Reservoir Levels Drop highlights a developing economy story with wider consequences for communities, institutions, and the global conversation.</p>
          <div class="hero-description">Spain Faces Water Crisis as Reservoir Levels Drop highlights a developing economy story with wider consequences for communities, institutions, and the global conversation.<br><br>Beyond the headline, spain faces water crisis as reservoir levels drop points to a wider shift in how governments, communities, and institutions are responding to pressure. In economy coverage, even one development can quickly ripple into policy debates, public safety concerns, or renewed calls for action.<br><br>Observers are also watching the human side of the story. The immediate details matter, but so do the long-term effects on local communities, public trust, and the way international audiences understand what is happening.<br><br>That is why this report matters beyond a single news cycle. It adds another piece to a broader world picture, showing how fast-moving events connect to deeper questions about accountability, resilience, and what happens next.</div>

          <div class="section-divider"></div>

          <div class="reactions">
            <div class="reactions-title">How do you feel about this article?</div>
            <div class="reaction-buttons"></div>
          </div>

          <div class="section-divider"></div>

          <div class="news-related">
            <h5 class="news-related-title">RELATED STORIES</h5>
            <a class="news-related-container" href="article-worldnews-a-hospital-staff-member-maintains-sterile-and-safe-conditions-for-patients-and-h.php">
              <div class="news-related-image"><img src="https://image3.photobiz.com/8929/32_20210222193341_7867839_large.jpg" alt="A hospital staff member maintains sterile and safe conditions for patients and healthcare workers." loading="lazy"></div>
              <span class="news-related-headline">A hospital staff member maintains sterile and safe conditions for patients and healthcare workers.</span>
            </a>
            <a class="news-related-container" href="article-worldnews-a-kenya-red-cross-society-volunteer-assists-a-community-member-navigating-a-floo.php">
              <div class="news-related-image"><img src="https://www.kobotoolbox.org/assets/images/blog/krcs-kenya-01.jpg" alt="A Kenya Red Cross Society volunteer assists a community member navigating a flooded area during the heavy rains and flooding crisis." loading="lazy"></div>
              <span class="news-related-headline">A Kenya Red Cross Society volunteer assists a community member navigating a flooded area during the heavy rains and flooding crisis.</span>
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
            <div class="sidebar-image"><img src="https://image3.photobiz.com/8929/32_20210222193341_7867839_large.jpg" alt="A hospital staff member maintains sterile and safe conditions for patients and healthcare workers." loading="lazy"></div>
            <div class="sidebar-story1">
              <a href="article-worldnews-a-hospital-staff-member-maintains-sterile-and-safe-conditions-for-patients-and-h.php"><h3 class="sidebar-headline">A hospital staff member maintains sterile and safe conditions for patients and healthcare workers.</h3></a>
              <span class="sidebar-category">Health</span>
              <div class="sidebar-meta">
                <button class="sidebar-share">FB SHARE</button>
                <button class="sidebar-tweet">TWEET</button>
              </div>
            </div>
          </div>
          <div class="sidebar-story">
            <div class="sidebar-image"><img src="https://www.kobotoolbox.org/assets/images/blog/krcs-kenya-01.jpg" alt="A Kenya Red Cross Society volunteer assists a community member navigating a flooded area during the heavy rains and flooding crisis." loading="lazy"></div>
            <div class="sidebar-story1">
              <a href="article-worldnews-a-kenya-red-cross-society-volunteer-assists-a-community-member-navigating-a-floo.php"><h3 class="sidebar-headline">A Kenya Red Cross Society volunteer assists a community member navigating a flooded area during the heavy rains and flooding crisis.</h3></a>
              <span class="sidebar-category">Humanity</span>
              <div class="sidebar-meta">
                <button class="sidebar-share">FB SHARE</button>
                <button class="sidebar-tweet">TWEET</button>
              </div>
            </div>
          </div>
          <div class="sidebar-story">
            <div class="sidebar-image"><img src="https://images.squarespace-cdn.com/content/v1/5d0dc22f70b70c00015d510a/1579611302969-92244A7OWXJ9E9HC5GI1/image-asset.jpeg?format=2500w" alt="A visual journey along the roadside in the Philippines, capturing everyday life and overlooked realities of local communities." loading="lazy"></div>
            <div class="sidebar-story1">
              <a href="article-worldnews-a-visual-journey-along-the-roadside-in-the-philippines-capturing-everyday-life-a.php"><h3 class="sidebar-headline">A visual journey along the roadside in the Philippines, capturing everyday life and overlooked realities of local communities.</h3></a>
              <span class="sidebar-category">Humanity</span>
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

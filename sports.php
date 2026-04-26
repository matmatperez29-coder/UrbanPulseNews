<?php
$pageId = 'sports';
require_once __DIR__ . '/php/db.php';
require_once 'php/php/auth.php'; // This also starts the session and connects to the DB
$currentUser = getCurrentUser(); // Returns user data if logged in, or null if not
?>
<!DOCTYPE html>

<html>
<head>
<title> UrbanPulse | Sports Page </title>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&amp;family=Source+Sans+3:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="css/navfooter.css" rel="stylesheet"/>
<link href="css/sports.css" rel="stylesheet"/>
<link href="css/burgermenu.css" rel="stylesheet"/>
<link href="css/theme.css" rel="stylesheet"/>
<link href="css/pulse-features.css" rel="stylesheet"/>
<link href="IMAGES/UrbanPulse.png" rel="icon" type="image/x-icon"/>
<style>
      .active {
        color: #c8102e;
        text-decoration-color: #c8102e;
        text-decoration: underline;
        text-decoration-thickness: 1.5px;
      }
      .article-link,
      .article-link:visited,
      .article-link:hover {
        color: inherit;
        text-decoration: none;
      }
      .article-media-link {
        display: block;
        color: inherit;
        text-decoration: none;
      }
      .hero-title,
      .news-card-title,
      .review-title,
      .sidebar-title,
      .story-title,
      .sport-main-title,
      .compact-title,
      .list-title,
      .trending-title {
        display: inline-block;
        transition: color 0.22s ease, transform 0.22s ease, text-decoration-color 0.22s ease;
      }
      .hero-article:hover .hero-title,
      .news-card:hover .news-card-title,
      .review-card:hover .review-title,
      .sidebar-story:hover .sidebar-title,
      .trending-item:hover .trending-title,
      .hero-main:hover .hero-title,
      .story-card:hover .story-title,
      .sport-main:hover .sport-main-title,
      .compact-story:hover .compact-title,
      .list-story:hover .list-title,
      .article-link:hover .hero-title,
      .article-link:hover .news-card-title,
      .article-link:hover .review-title,
      .article-link:hover .sidebar-title,
      .article-link:hover .story-title,
      .article-link:hover .sport-main-title,
      .article-link:hover .compact-title,
      .article-link:hover .list-title,
      .article-link:hover .trending-title {
        color: #c8102e;
        text-decoration: underline;
        text-decoration-color: #c8102e;
        text-decoration-thickness: 1.5px;
        text-underline-offset: 3px;
        transform: translateX(4px);
      }
      main {
        padding-top: 1rem;
      }
    </style>
<link href="css/category-approved-section.css" rel="stylesheet"/>
<link href="css/main-page-enhancements.css" rel="stylesheet"/></head>
<body data-page="&lt;?php echo htmlspecialchars($pageId, ENT_QUOTES, 'UTF-8'); ?&gt;">
<!-- BREAKING NEWS STICKER -->
<?php require_once 'nav.php'; ?>
<main>
<div class="container">
<section aria-label="Sports tools" class="tools-bar">
<div class="tools-field">
<label class="tools-label" for="categoryFilter">Filter by sport</label>
<select class="tools-select" id="categoryFilter">
<option value="all">All sports</option>
<option value="football">American Football</option>
<option value="basketball">Basketball</option>
<option value="soccer">Football / Soccer</option>
<option value="tennis">Tennis</option>
<option value="baseball">Baseball</option>
</select>
</div>
<div class="tools-field">
<label class="tools-label" for="dateFilter">Filter by date</label>
<select class="tools-select" id="dateFilter">
<option value="all">All dates</option>
<option value="today">Today</option>
<option value="this-week">This week</option>
<option value="this-month">This month</option>
</select>
</div>
</section>
<div class="filter-empty" id="filterEmpty">No sports stories match your current search and filter combination.</div>
<section class="hero-featured" data-filter-section="">
<article class="hero-main filter-item card-linkable" data-article-url="article-eagles-super-bowl.php" data-category="football" data-date="2025-02-09" data-search="Eagles Chiefs Super Bowl LIX Jalen Hurts Patrick Mahomes Cooper DeJean Marcus Thompson football NFL title">
<a class="article-media-link" href="article-eagles-super-bowl.php"><div class="media-slot hero-image media-has-image"><img alt="Eagles Dethrone Chiefs to Claim Super Bowl LIX Title" loading="lazy" src="images/sports/eagles-super-bowl-lix.jpg"/></div></a>
<span class="hero-category">American Football</span>
<a class="article-link" href="article-eagles-super-bowl.php"><h2 class="hero-title">Eagles Dethrone Chiefs to Claim Super Bowl LIX Title</h2></a>
<p class="hero-excerpt">Philadelphia overwhelmed Kansas City 40-22 at the Caesars Superdome and denied Patrick Mahomes a three-peat. The defense set the tone with six sacks and three takeaways while Jalen Hurts led the offense to a statement win.</p>
<div class="read-more-content" hidden="" id="sportsHeroMore">
<p class="hero-copy">Rookie Cooper DeJean delivered one of the signature plays of the night with a 38-yard pick-six, becoming only the second rookie to do it on the Super Bowl stage. Hurts added nearly 300 passing yards and two rushing touchdowns, including the trademark tush push that helped seal the result.</p>
<p class="hero-copy">The championship gave Philadelphia its second title and served as redemption for the franchise after falling to Kansas City in Super Bowl LVII.</p>
</div>
<button aria-expanded="false" class="read-more-btn" data-read-more="sportsHeroMore" type="button">Read more</button>
<div class="hero-meta">
<span class="hero-author">Marcus Thompson</span>
<span>•</span>
<span>February 9, 2025</span>
<span>•</span>
<span>6:30 PM EST</span>
</div>
</article>
<aside class="hero-sidebar">
<article class="sidebar-story filter-item card-linkable" data-article-url="article-thunder-strike-gold.php" data-category="basketball" data-date="2025-06-22" data-search="Thunder OKC NBA Finals Gilgeous-Alexander Holmgren Haliburton Sarah Jenkins basketball championship">
<span class="sidebar-category">Basketball</span>
<a class="article-link" href="article-thunder-strike-gold.php"><h3 class="sidebar-title">Thunder Strike Gold with OKC's First NBA Title Since 1979</h3></a>
<div class="sidebar-meta"><span>Sarah Jenkins</span><span>•</span><span>June 22, 2025</span></div>
</article>
<article class="sidebar-story filter-item card-linkable" data-article-url="article-psg-historic-treble.php" data-category="soccer" data-date="2025-05-31" data-search="PSG Champions League Inter Milan treble Luis Enrique James Pratt soccer football UCL">
<span class="sidebar-category">Football / Soccer</span>
<a class="article-link" href="article-psg-historic-treble.php"><h3 class="sidebar-title">PSG Complete a Historic Treble with a Ruthless 5-0 Final</h3></a>
<div class="sidebar-meta"><span>James Pratt</span><span>•</span><span>May 31, 2025</span></div>
</article>
<article class="sidebar-story filter-item card-linkable" data-article-url="article-wimbledon-spotlight.php" data-category="tennis" data-date="2025-07-13" data-search="Wimbledon Sinner Swiatek Carlos Alcaraz Amanda Anisimova Elena Costas tennis finals">
<span class="sidebar-category">Tennis</span>
<a class="article-link" href="article-wimbledon-spotlight.php"><h3 class="sidebar-title">Sinner and Swiatek Own the Wimbledon Spotlight</h3></a>
<div class="sidebar-meta"><span>Elena Costas</span><span>•</span><span>July 13, 2025</span></div>
</article>
<article class="sidebar-story filter-item card-linkable" data-article-url="article-dodgers-thriller.php" data-category="baseball" data-date="2025-11-02" data-search="Dodgers Blue Jays World Series Ohtani Yamamoto David Sutherland baseball back to back titles">
<span class="sidebar-category">Baseball</span>
<a class="article-link" href="article-dodgers-thriller.php"><h3 class="sidebar-title">Dodgers Go Back-to-Back in an 11-Inning World Series Thriller</h3></a>
<div class="sidebar-meta"><span>David Sutherland</span><span>•</span><span>November 2, 2025</span></div>
</article>
</aside>
</section>
<div class="section-divider"></div>
<section data-filter-section="">
<div class="section-header">
<h2 class="section-title">Fast scoreboard snapshot</h2>
<span class="section-link">Season-defining headlines</span>
</div>
<div class="quick-stats">
<div class="stat-card filter-item" data-category="football" data-date="2025-02-09" data-search="40-22 Eagles Chiefs Super Bowl score">
<strong>40-22</strong>
<span>Eagles over Chiefs in Super Bowl LIX</span>
</div>
<div class="stat-card filter-item" data-category="basketball" data-date="2025-06-22" data-search="103-91 Thunder Pacers Game 7 NBA finals score">
<strong>103-91</strong>
<span>Thunder over Pacers in Game 7</span>
</div>
<div class="stat-card filter-item" data-category="soccer" data-date="2025-05-31" data-search="5-0 PSG Inter Milan Champions League final score">
<strong>5-0</strong>
<span>PSG rout Inter Milan in the UCL final</span>
</div>
<div class="stat-card filter-item" data-category="tennis" data-date="2025-07-13" data-search="6-0 6-0 Swiatek Wimbledon final score double bagel">
<strong>6-0, 6-0</strong>
<span>Swiatek's historic Wimbledon final</span>
</div>
</div>
</section>
<div class="section-divider"></div>
<section data-filter-section="">
<div class="section-header">
<h2 class="section-title">Latest stories</h2>
<span class="section-link">Card layout</span>
</div>
<div class="story-grid">
<article class="story-card filter-item card-linkable" data-article-url="article-okc-thunder.php" data-category="basketball" data-date="2025-06-22" data-search="Thunder OKC NBA title Gilgeous-Alexander Holmgren Jalen Williams Pacers basketball">
<a class="article-media-link" href="article-okc-thunder.php"><div class="media-slot story-image media-has-image"><img alt="Thunder Strike Gold: OKC Wins Its First NBA Title Since 1979" loading="lazy" src="images/sports/okc-first-nba-title.jpg"/></div></a>
<span class="story-pill">Basketball</span>
<a class="article-link" href="article-okc-thunder.php"><h3 class="story-title">Thunder Strike Gold: OKC Wins Its First NBA Title Since 1979</h3></a>
<p class="story-excerpt">Shai Gilgeous-Alexander powered Oklahoma City to a 103-91 Game 7 win over Indiana and capped an unforgettable season with MVP and Finals MVP honors.</p>
<div class="read-more-content" hidden="" id="sportsCard1"><p class="sport-copy">After Tyrese Haliburton went down early in the third quarter, OKC ripped off a 19-2 run. Chet Holmgren's rim protection and Jalen Williams' scoring helped secure the Larry O'Brien Trophy.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="sportsCard1" type="button">Read more</button>
<div class="story-meta"><span class="story-author">Sarah Jenkins</span><span>•</span><span>June 22, 2025</span></div>
</article>
<article class="story-card filter-item card-linkable" data-article-url="article-psg.php" data-category="soccer" data-date="2025-05-31" data-search="PSG treble Champions League Inter Milan Doue Hakimi Kvaratskhelia soccer football">
<a class="article-media-link" href="article-psg.php"><div class="media-slot story-image media-has-image"><img alt="PSG Secure a Maiden Champions League and Complete the Treble" loading="lazy" src="images/sports/psg-champions-league-breakthrough.jpg"/></div></a>
<span class="story-pill">Football / Soccer</span>
<a class="article-link" href="article-psg.php"><h3 class="story-title">PSG Secure a Maiden Champions League and Complete the Treble</h3></a>
<p class="story-excerpt">Paris Saint-Germain crushed Inter Milan 5-0 in Munich and became the first French club to complete a continental treble.</p>
<div class="read-more-content" hidden="" id="sportsCard2"><p class="sport-copy">Désiré Doué scored twice while Achraf Hakimi, Khvicha Kvaratskhelia, and Senny Mayulu added goals in the most lopsided single-leg Champions League final on record.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="sportsCard2" type="button">Read more</button>
<div class="story-meta"><span class="story-author">James Pratt</span><span>•</span><span>May 31, 2025</span></div>
</article>
<article class="story-card filter-item card-linkable" data-article-url="article-wimbledon.php" data-category="tennis" data-date="2025-07-13" data-search="Sinner Swiatek Wimbledon Alcaraz Anisimova tennis grass Elena Costas">
<a class="article-media-link" href="article-wimbledon.php"><div class="media-slot story-image media-has-image"><img alt="Sinner and Swiatek Dominate Historic Wimbledon Finals" loading="lazy" src="images/sports/wimbledon-historic-finals.jpg"/></div></a>
<span class="story-pill">Tennis</span>
<a class="article-link" href="article-wimbledon.php"><h3 class="story-title">Sinner and Swiatek Dominate Historic Wimbledon Finals</h3></a>
<p class="story-excerpt">Jannik Sinner outlasted Carlos Alcaraz, while Iga Swiatek delivered a rare double-bagel final to win her first Wimbledon crown.</p>
<div class="read-more-content" hidden="" id="sportsCard3"><p class="sport-copy">Sinner stopped Alcaraz's 20-match grass winning streak, and Swiatek's 6-0, 6-0 victory became the first double-bagel Grand Slam final since 1988.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="sportsCard3" type="button">Read more</button>
<div class="story-meta"><span class="story-author">Elena Costas</span><span>•</span><span>July 13, 2025</span></div>
</article>
</div>
</section>
<div class="section-divider"></div>
<section class="sport-section" data-filter-section="">
<div class="sport-header">
<h2 class="sport-title">Championship spotlight</h2>
<span class="section-link">Longer reads</span>
</div>
<div class="sport-grid">
<article class="sport-main filter-item card-linkable" data-article-url="article-dodgers.php" data-category="baseball" data-date="2025-11-02" data-search="Dodgers Blue Jays World Series Ohtani Rojas Will Smith Yamamoto baseball">
<a class="article-media-link" href="article-dodgers.php"><div class="media-slot sport-main-image media-has-image"><img alt="Dodger Dynasty: L.A. Clinches Back-to-Back Titles in an 11-Inning Classic" loading="lazy" src="images/sports/dodgers-back-to-back-titles.jpg"/></div></a>
<span class="story-pill">Baseball</span>
<a class="article-link" href="article-dodgers.php"><h3 class="sport-main-title">Dodger Dynasty: L.A. Clinches Back-to-Back Titles in an 11-Inning Classic</h3></a>
<p class="sport-copy">Los Angeles rallied from a 4-2 ninth-inning deficit before edging Toronto 5-4 in Game 7 to become the first repeat World Series champion in 25 years.</p>
<div class="read-more-content" hidden="" id="sportsFeatureMore">
<p class="sport-copy">Miguel Rojas tied the game with a two-out solo shot in the ninth, and Will Smith delivered the decisive blow in the eleventh. Yoshinobu Yamamoto then shut the door after working in relief just a day after a 96-pitch start.</p>
<p class="sport-copy">Shohei Ohtani finished the postseason batting .333, helping seal the Dodgers' place as one of baseball's defining modern dynasties.</p>
</div>
<button aria-expanded="false" class="read-more-btn" data-read-more="sportsFeatureMore" type="button">Read more</button>
<div class="hero-meta"><span class="hero-author">David Sutherland</span><span>•</span><span>November 2, 2025</span><span>•</span><span>8:00 PM EST</span></div>
</article>
<aside class="sport-sidebar">
<article class="compact-story filter-item card-linkable" data-article-url="article-hurts-statement-performance.php" data-category="football" data-date="2025-02-09" data-search="Hurts MVP tush push Chiefs Eagles Super Bowl football">
<span class="story-pill">Football</span>
<a class="article-link" href="article-hurts-statement-performance.php"><h4 class="compact-title">Hurts' all-around control turned the Super Bowl into a statement performance</h4></a>
<div class="compact-meta"><span>Marcus Thompson</span><span>•</span><span>Player of the night</span></div>
</article>
<article class="compact-story filter-item card-linkable" data-article-url="article-holmgren-williams-third-quarter.php" data-category="basketball" data-date="2025-06-22" data-search="Holmgren 5 blocks Jalen Williams 20 points Thunder Pacers basketball">
<span class="story-pill">Basketball</span>
<a class="article-link" href="article-holmgren-williams-third-quarter.php"><h4 class="compact-title">Holmgren and Williams gave OKC the push it needed in the third quarter</h4></a>
<div class="compact-meta"><span>Sarah Jenkins</span><span>•</span><span>Game 7 swing</span></div>
</article>
<article class="compact-story filter-item card-linkable" data-article-url="article-luis-enrique-breakthrough.php" data-category="soccer" data-date="2025-05-31" data-search="Luis Enrique French club first continental treble PSG soccer">
<span class="story-pill">Football / Soccer</span>
<a class="article-link" href="article-luis-enrique-breakthrough.php"><h4 class="compact-title">Luis Enrique finally led PSG to the European breakthrough they chased for years</h4></a>
<div class="compact-meta"><span>James Pratt</span><span>•</span><span>Historic night</span></div>
</article>
<article class="compact-story filter-item card-linkable" data-article-url="article-wimbledon-breakthrough-statement.php" data-category="tennis" data-date="2025-07-13" data-search="double bagel Grand Slam final Swiatek Sinner Wimbledon tennis">
<span class="story-pill">Tennis</span>
<a class="article-link" href="article-wimbledon-breakthrough-statement.php"><h4 class="compact-title">Wimbledon delivered one breakthrough and one unforgettable statement win</h4></a>
<div class="compact-meta"><span>Elena Costas</span><span>•</span><span>Centre Court story</span></div>
</article>
</aside>
</div>
</section>
<div class="section-divider"></div>
<section data-filter-section="">
<div class="section-header">
<h2 class="section-title">Full rundown</h2>
<span class="section-link">List layout</span>
</div>
<div class="story-list">
<article class="list-story filter-item card-linkable" data-article-url="article-philadelphia-defense-script.php" data-category="football" data-date="2025-02-09" data-search="Eagles Chiefs Super Bowl DeJean Hurts football">
<div class="media-slot list-image media-has-image"><img alt="Philadelphia's defense wrote the script from start to finish" loading="lazy" src="images/sports/eagles-defense-super-bowl.jpg"/></div>
<div class="list-content">
<span class="story-pill">American Football</span>
<a class="article-link" href="article-philadelphia-defense-script.php"><h3 class="list-title">Philadelphia's defense wrote the script from start to finish</h3></a>
<p class="list-copy">Six sacks, three turnovers, and a pick-six from Cooper DeJean turned the biggest game of the year into a showcase for the Eagles' balance on both sides of the ball.</p>
<div class="story-meta"><span class="story-author">Marcus Thompson</span><span>•</span><span>Super Bowl LIX</span></div>
</div>
</article>
<article class="list-story filter-item card-linkable" data-article-url="article-shai-rarest-sweep.php" data-category="basketball" data-date="2025-06-22" data-search="Shai MVP scoring title Finals MVP Thunder basketball">
<div class="media-slot list-image media-has-image"><img alt="Shai's season ended with the rarest kind of sweep of individual honors" loading="lazy" src="images/sports/shai-individual-honors.jpg"/></div>
<div class="list-content">
<span class="story-pill">Basketball</span>
<a class="article-link" href="article-shai-rarest-sweep.php"><h3 class="list-title">Shai's season ended with the rarest kind of sweep of individual honors</h3></a>
<p class="list-copy">He became the first player since Shaquille O'Neal in 2000 to win the scoring title, league MVP, and Finals MVP in the same year.</p>
<div class="story-meta"><span class="story-author">Sarah Jenkins</span><span>•</span><span>NBA Finals</span></div>
</div>
</article>
<article class="list-story filter-item card-linkable" data-article-url="article-psg-complete-version.php" data-category="soccer" data-date="2025-05-31" data-search="Doue Hakimi Kvaratskhelia Mayulu PSG Champions League soccer">
<div class="media-slot list-image media-has-image"><img alt="PSG finally looked like the complete version of themselves" loading="lazy" src="images/sports/psg-complete-team-performance.jpg"/></div>
<div class="list-content">
<span class="story-pill">Football / Soccer</span>
<a class="article-link" href="article-psg-complete-version.php"><h3 class="list-title">PSG finally looked like the complete version of themselves</h3></a>
<p class="list-copy">They dominated possession, overwhelmed Inter, and turned the club's most important final into a performance with no visible cracks.</p>
<div class="story-meta"><span class="story-author">James Pratt</span><span>•</span><span>Champions League Final</span></div>
</div>
</article>
</div>
</section>
<?php require_once 'php/php/category-approved-section.php'; renderApprovedCategorySection(getDB(), 'sports', ['title' => 'Approved sports articles', 'eyebrow' => 'Editorial review']); ?>
<div class="section-divider"></div>
<section class="newsletter-section">
<div>
<h2 class="newsletter-title">Get the next sports wave before it becomes everyone else's headline</h2>
<p class="newsletter-description">This section stays styled like the rest of UrbanPulse, but it now fits the sports page better and no longer feels detached from the content above it.</p>
</div>
<a class="newsletter-cta" href="subscription.php">Subscribe now</a>
</section>
</div>
</main>
<footer class="footer">
<div class="footer-container">
<div class="footer-content">
<div class="footer-section">
<h3>UrbanPulse</h3>
<p>
              Independent journalism you can trust. Delivering truth in every
              story since 2026.
            </p>
<div class="footer-social">
<a aria-label="Facebook" href="#"> FB </a>
<a aria-label="Twitter" href="#"> TW </a>
<a aria-label="Instagram" href="#"> IG </a>
<a aria-label="Github" href="#"> GH </a>
</div>
</div>
<div class="footer-section">
<h4>Categories</h4>
<ul>
<li><a href="technology.php"> Technology </a></li>
<li><a href="sports.php"> Sports </a></li>
<li><a href="entertainment.php"> Entertainment</a></li>
<li><a href="worldnews.php"> World News </a></li>
</ul>
</div>
<div class="footer-section">
<h4>Company</h4>
<ul>
<li><a href="about.php">About Us</a></li>
<li><a href="contact.php">Contact</a></li>
<li><a href="#">Careers</a></li>
<li><a href="#">Advertise</a></li>
</ul>
</div>
<div class="footer-section">
<h4>Pledge</h4>
<p id="pledge">
              We, the UrbanPulse team, pledge to deliver news that keeps people
              informed, aware, and always updated. Inspired by our school’s
              champion radio broadcasting team, we carry the same goal: to share
              information clearly, quickly, and with purpose.
            </p>
</div>
</div>
<div class="footer-bottom">
<p>© 2026 UrbanPulse News. All rights reserved.</p>
</div>
</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/burger.js"></script>
<script src="js/theme.js"></script>
<script src="js/search.js"></script>
<script src="js/filter.js"></script>
<script src="js/interactions.js"></script>
<script src="js/editorial-tools.js"></script><script src="js/pulse-features.js"></script>
<script src="js/article-js/interactions.js"></script>
<script src="js/main-page-links.js"></script></body>
</html>
<?php
$pageId = 'technology';
require_once 'db.php';
require_once 'auth.php'; // This also starts the session and connects to the DB
$currentUser = getCurrentUser(); // Returns user data if logged in, or null if not
?>
<!DOCTYPE html>

<html>
<head>
<title> UrbanPulse | Technology Page </title>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&amp;family=Source+Sans+3:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="navfooter.css" rel="stylesheet"/>
<link href="technology.css" rel="stylesheet"/>
<link href="burgermenu.css" rel="stylesheet"/>
<link href="theme.css" rel="stylesheet"/>
<link href="pulse-features.css" rel="stylesheet"/>
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
<link href="category-approved-section.css" rel="stylesheet"/>
<link href="main-page-enhancements.css" rel="stylesheet"/></head>
<body data-page="&lt;?php echo htmlspecialchars($pageId, ENT_QUOTES, 'UTF-8'); ?&gt;">
<!-- BREAKING NEWS STICKER -->
<?php require_once 'nav.php'; ?>
<main>
<div class="container">
<section aria-label="Technology tools" class="tools-bar">
<div class="tools-field">
<label class="tools-label" for="categoryFilter">Filter by topic</label>
<select class="tools-select" id="categoryFilter">
<option value="all">All technology</option>
<option value="ai">AI and Robotics</option>
<option value="hardware">Infrastructure and Hardware</option>
<option value="science">Cybersecurity and Science</option>
<option value="consumer">Consumer Technology</option>
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
<div class="filter-empty" id="filterEmpty">No technology stories match your current search and filter combination.</div>
<div class="page-layout">
<div class="main-content">
<article class="hero-article filter-item card-linkable" data-article-url="article-ai-agentic-revolution.php" data-category="ai" data-date="2026-02-23" data-search="Agentic AI autonomous systems workflows supply chains trust safety Aris Thorne">
<a class="article-media-link" href="article-ai-agentic-revolution.php"><div class="media-slot hero-image media-has-image"><img alt="The Transition to Agentic AI and Autonomous Systems" loading="lazy" src="images/technology/agentic-ai-revolution.jpg"/></div></a>
<span class="hero-category">AI and Robotics</span>
<a class="article-link" href="article-ai-agentic-revolution.php"><h2 class="hero-title">The Transition to Agentic AI and Autonomous Systems</h2></a>
<p class="hero-excerpt">The latest wave of AI is moving beyond simple prompt-and-response tools. Enterprises are now deploying agents that can manage multi-step workflows, assign responsibility, and optimize operations with far less human guidance.</p>
<div class="read-more-content" hidden="" id="techHeroMore">
<p class="hero-copy">That productivity jump also creates a harder question: when AI handles thousands of micro-decisions each day, traditional human review becomes unrealistic. The conversation is shifting from direct oversight to how trust, safety, and accountability are engineered into the logic itself.</p>
<p class="hero-copy">In other words, this is not just a software update. It is becoming an operating model change for entire organizations.</p>
</div>
<button aria-expanded="false" class="read-more-btn" data-read-more="techHeroMore" type="button">Read more</button>
<div class="hero-meta"><span class="hero-author">Aris Thorne</span><span>•</span><span>February 23, 2026</span><span>•</span><span>9:00 AM PST</span></div>
</article>
<div class="section-divider"></div>
<section data-filter-section="">
<div class="section-header">
<h2 class="section-title">Signals to watch</h2>
<span class="section-link">Big themes</span>
</div>
<div class="signal-strip">
<div class="signal-card filter-item" data-category="ai" data-date="2026-02-23" data-search="persistent memory emotional intelligence GPT-6 beta">
<strong>Persistent memory</strong>
<span>GPT-6 style continuity becomes a defining AI conversation</span>
</div>
<div class="signal-card filter-item" data-category="hardware" data-date="2026-02-23" data-search="orbital fuel transfer Starship 5 Artemis III">
<strong>Orbital refueling</strong>
<span>Starship architecture takes a major step toward the Moon and Mars</span>
</div>
<div class="signal-card filter-item" data-category="science" data-date="2026-02-23" data-search="1D electron behavior room temperature superconductors quantum materials">
<strong>1D electron flow</strong>
<span>Quantum materials research edges closer to huge hardware gains</span>
</div>
</div>
</section>
<div class="section-divider"></div>
<section data-filter-section="">
<div class="section-header">
<h2 class="section-title">Latest news</h2>
<span class="section-link">Card layout</span>
</div>
<div class="news-grid">
<article class="news-card filter-item card-linkable" data-article-url="article-gpt6-beta.php" data-category="ai" data-date="2026-02-23" data-search="GPT-6 beta near-human emotional reasoning persistent memory privacy Julian Vane">
<a class="article-media-link" href="article-gpt6-beta.php"><div class="media-slot news-card-image media-has-image"><img alt="GPT-6 Early Beta Users Report Near-Human Emotional Reasoning" loading="lazy" src="images/technology/gpt6-emotional-reasoning.jpg"/></div></a>
<span class="news-card-category">AI and Robotics</span>
<a class="article-link" href="article-gpt6-beta.php"><h3 class="news-card-title">GPT-6 Early Beta Users Report Near-Human Emotional Reasoning</h3></a>
<p class="news-card-excerpt">The beta reportedly remembers preferences and emotional tone across long conversations, making the experience feel more continuous and personal than earlier models.</p>
<div class="read-more-content" hidden="" id="techCard1"><p class="review-copy">That same memory layer raises fresh privacy questions, and the debate is already moving toward how persistent AI memory should be protected and governed.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="techCard1" type="button">Read more</button>
<div class="news-card-meta"><span class="news-card-author">Julian Vane</span><span>•</span><span>11:15 AM EST</span></div>
</article>
<article class="news-card filter-item card-linkable" data-article-url="article-humanoid-robots.php" data-category="ai" data-date="2026-02-23" data-search="Humanoid robots manufacturing lines Optimus Digit Electric Atlas Sarah Jenkins robotics">
<a class="article-media-link" href="article-humanoid-robots.php"><div class="media-slot news-card-image media-has-image"><img alt="Humanoid Robots Join Global Manufacturing Lines" loading="lazy" src="images/technology/humanoid-robots-manufacturing.jpg"/></div></a>
<span class="news-card-category">AI and Robotics</span>
<a class="article-link" href="article-humanoid-robots.php"><h3 class="news-card-title">Humanoid Robots Join Global Manufacturing Lines</h3></a>
<p class="news-card-excerpt">General-purpose bipedal robots are now moving from pilot tests into full deployments across automotive and logistics facilities.</p>
<div class="read-more-content" hidden="" id="techCard2"><p class="review-copy">The shift changes the role of factory workers too, pulling more value into supervision, orchestration, and fleet management rather than pure physical labor.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="techCard2" type="button">Read more</button>
<div class="news-card-meta"><span class="news-card-author">Sarah Jenkins</span><span>•</span><span>2:45 PM GMT</span></div>
</article>
<article class="news-card filter-item card-linkable" data-article-url="article-meta-messenger.php" data-category="hardware" data-date="2026-02-23" data-search="Messenger desktop website April 2026 Meta messenger.com Sharona Nicole Semilla">
<a class="article-media-link" href="article-meta-messenger.php"><div class="media-slot news-card-image media-has-image"><img alt="Meta to Shut Down Messenger Desktop Website in April 2026" loading="lazy" src="images/technology/meta-messenger-desktop-shutdown.jpg"/></div></a>
<span class="news-card-category">Infrastructure and Hardware</span>
<a class="article-link" href="article-meta-messenger.php"><h3 class="news-card-title">Meta to Shut Down Messenger Desktop Website in April 2026</h3></a>
<p class="news-card-excerpt">Messenger.com is heading for retirement as Meta folds desktop messaging more tightly into Facebook's main ecosystem.</p>
<div class="read-more-content" hidden="" id="techCard3"><p class="review-copy">The move streamlines Meta's platform strategy, but it also frustrates users who preferred a standalone and distraction-free messaging space.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="techCard3" type="button">Read more</button>
<div class="news-card-meta"><span class="news-card-author">Sharona Nicole Semilla</span><span>•</span><span>10:09 PM PHT</span></div>
</article>
<article class="news-card filter-item card-linkable" data-article-url="article-starship-fuel-transfer.php" data-category="hardware" data-date="2026-02-23" data-search="Starship 5 orbital fuel transfer Artemis III David Sutherland SpaceX Moon Mars">
<a class="article-media-link" href="article-starship-fuel-transfer.php"><div class="media-slot news-card-image media-has-image"><img alt="SpaceX Starship 5 Completes First Orbital Fuel Transfer" loading="lazy" src="images/technology/spacex-orbital-fuel-transfer.jpg"/></div></a>
<span class="news-card-category">Infrastructure and Hardware</span>
<a class="article-link" href="article-starship-fuel-transfer.php"><h3 class="news-card-title">SpaceX Starship 5 Completes First Orbital Fuel Transfer</h3></a>
<p class="news-card-excerpt">A successful cryogenic transfer in orbit strengthened the case for lunar cargo missions and future long-duration Mars plans.</p>
<div class="read-more-content" hidden="" id="techCard4"><p class="review-copy">For NASA's Artemis III plans, it removes one of the biggest technical obstacles and makes the Moon architecture feel much more concrete.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="techCard4" type="button">Read more</button>
<div class="news-card-meta"><span class="news-card-author">David Sutherland</span><span>•</span><span>3:30 PM CST</span></div>
</article>
<article class="news-card filter-item card-linkable" data-article-url="article-quantum.php" data-category="science" data-date="2026-02-23" data-search="Quantum materials true 1D electron behavior Elena Costas superconductors pinball phase">
<a class="article-media-link" href="article-quantum.php"><div class="media-slot news-card-image media-has-image"><img alt="Quantum Materials Researchers Confirm True 1D Electron Behavior" loading="lazy" src="images/technology/quantum-1d-electron-behavior.jpg"/></div></a>
<span class="news-card-category">Cybersecurity and Science</span>
<a class="article-link" href="article-quantum.php"><h3 class="news-card-title">Quantum Materials Researchers Confirm True 1D Electron Behavior</h3></a>
<p class="news-card-excerpt">Scientists observed electrons moving in a one-dimensional file inside synthetic crystals, opening a path toward more resilient and faster hardware.</p>
<div class="read-more-content" hidden="" id="techCard5"><p class="review-copy">The newly confirmed pinball phase is especially important because it could help future systems move closer to room-temperature superconductors.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="techCard5" type="button">Read more</button>
<div class="news-card-meta"><span class="news-card-author">Elena Costas</span><span>•</span><span>11:00 AM EST</span></div>
</article>
<article class="news-card filter-item card-linkable" data-article-url="article-australia-ai.php" data-category="science" data-date="2026-02-23" data-search="Australia sovereign AI factory NVIDIA Cisco Marcus Thompson Sydney digital sovereignty">
<a class="article-media-link" href="article-australia-ai.php"><div class="media-slot news-card-image media-has-image"><img alt="Australia Launches Its First Secure Sovereign AI Factory" loading="lazy" src="images/technology/australia-sovereign-ai-factory.jpg"/></div></a>
<span class="news-card-category">Cybersecurity and Science</span>
<a class="article-link" href="article-australia-ai.php"><h3 class="news-card-title">Australia Launches Its First Secure Sovereign AI Factory</h3></a>
<p class="news-card-excerpt">NVIDIA and Cisco helped build a Sydney facility designed to keep sensitive AI workloads and national data within Australian borders.</p>
<div class="read-more-content" hidden="" id="techCard6"><p class="review-copy">It is a direct response to digital sovereignty concerns and a sign that AI infrastructure is becoming a geopolitical issue, not just a technical one.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="techCard6" type="button">Read more</button>
<div class="news-card-meta"><span class="news-card-author">Marcus Thompson</span><span>•</span><span>8:00 AM AEST</span></div>
</article>
</div>
</section>
<div class="section-divider"></div>
<section data-filter-section="">
<div class="section-header">
<h2 class="section-title">Consumer and industry deep dive</h2>
<span class="section-link">Mixed layout</span>
</div>
<div class="deep-dive-list">
<article class="review-card filter-item card-linkable" data-article-url="article-infinix.php" data-category="consumer" data-date="2026-02-23" data-search="Infinix Note 60 battery Snapdragon Active Matrix Sam Chen consumer technology smartphone">
<a class="article-media-link" href="article-infinix.php"><div class="review-image"><div class="media-slot media-has-image"><img alt="Infinix Unveils NOTE 60 Series with Revolutionary Battery Tech" loading="lazy" src="images/technology/infinix-note-60-battery-tech.jpg"/></div></div></a>
<div class="review-content">
<span class="review-label">Consumer Technology</span>
<a class="article-link" href="article-infinix.php"><h3 class="review-title">Infinix Unveils NOTE 60 Series with Revolutionary Battery Tech</h3></a>
<p class="review-copy">The NOTE 60 Pro pairs a 6,500 mAh battery with a slim body, brings Snapdragon chips back to the lineup, and adds an active matrix display for mini-games and smart alerts.</p>
<div class="read-more-content" hidden="" id="techReview1"><p class="review-copy">Its biggest promise is simple but important: light users can stretch usage close to a full week, which directly attacks one of the longest-running pain points in phones.</p></div>
<button aria-expanded="false" class="read-more-btn" data-read-more="techReview1" type="button">Read more</button>
<div class="review-meta"><span>Sam Chen</span><span>•</span><span>2:30 PM CST</span></div>
</div>
</article>
<article class="review-card filter-item card-linkable" data-article-url="article-human-on-the-loop-governance.php" data-category="ai" data-date="2026-02-23" data-search="human-on-the-loop safety governance agentic systems autonomous decisions trust">
<a class="article-media-link" href="article-human-on-the-loop-governance.php"><div class="review-image"><div class="media-slot media-has-image"><img alt="Why Human-on-the-Loop Governance Is Becoming Harder to Sustain" loading="lazy" src="images/technology/human-on-the-loop-governance.jpg"/></div></div></a>
<div class="review-content">
<span class="review-label">Industry Watch</span>
<a class="article-link" href="article-human-on-the-loop-governance.php"><h3 class="review-title">Why Human-on-the-Loop Governance Is Becoming Harder to Sustain</h3></a>
<p class="review-copy">As autonomous agents start handling thousands of decisions a day, manual review stops scaling. That shifts the focus toward guardrails and system design instead of direct human approval.</p>
<div class="review-meta"><span>Derived from the lead AI story</span></div>
</div>
</article>
<article class="review-card filter-item card-linkable" data-article-url="article-orbital-refueling-space-missions.php" data-category="hardware" data-date="2026-02-23" data-search="Moon Mars cargo architecture Starship fuel transfer hardware space missions">
<a class="article-media-link" href="article-orbital-refueling-space-missions.php"><div class="review-image"><div class="media-slot media-has-image"><img alt="Orbital Refueling Changes the Size of What Space Missions Can Attempt" loading="lazy" src="images/technology/orbital-refueling-space-missions.jpg"/></div></div></a>
<div class="review-content">
<span class="review-label">Mission Hardware</span>
<a class="article-link" href="article-orbital-refueling-space-missions.php"><h3 class="review-title">Orbital Refueling Changes the Size of What Space Missions Can Attempt</h3></a>
<p class="review-copy">By proving a ship can launch and then refuel in space, the architecture for heavier Moon cargo, repeated missions, and deeper exploration becomes much more realistic.</p>
<div class="review-meta"><span>Derived from the Starship story</span></div>
</div>
</article>
</div>
</section>
</div>
<aside class="sidebar">
<div class="sidebar-section" data-filter-section="">
<h3 class="sidebar-heading">Trending topics</h3>
<div class="trending-list">
<div class="trending-item filter-item card-linkable" data-article-url="article-persistent-memory-expectations.php" data-category="ai" data-date="2026-02-23" data-search="GPT-6 persistent memory emotional intelligence">
<div class="trending-number">01</div>
<div>
<span class="trending-category">AI</span>
<a class="article-link" href="article-persistent-memory-expectations.php"><h4 class="trending-title">Persistent memory is changing what users expect from AI chat</h4></a>
<div class="trending-meta">Julian Vane</div>
</div>
</div>
<div class="trending-item filter-item card-linkable" data-article-url="article-factory-floor-humanoids.php" data-category="ai" data-date="2026-02-23" data-search="humanoid robots manufacturing Tesla Agility Boston Dynamics">
<div class="trending-number">02</div>
<div>
<span class="trending-category">Robotics</span>
<a class="article-link" href="article-factory-floor-humanoids.php"><h4 class="trending-title">Factory floors are becoming the real test bed for humanoid robots</h4></a>
<div class="trending-meta">Sarah Jenkins</div>
</div>
</div>
<div class="trending-item filter-item card-linkable" data-article-url="article-pinball-phase-matters.php" data-category="science" data-date="2026-02-23" data-search="pinball phase superconductors quantum materials science">
<div class="trending-number">03</div>
<div>
<span class="trending-category">Science</span>
<a class="article-link" href="article-pinball-phase-matters.php"><h4 class="trending-title">The pinball phase could matter far beyond the lab</h4></a>
<div class="trending-meta">Elena Costas</div>
</div>
</div>
<div class="trending-item filter-item card-linkable" data-article-url="article-battery-life-headline-feature.php" data-category="consumer" data-date="2026-02-23" data-search="Infinix NOTE 60 battery lifespan consumer tech">
<div class="trending-number">04</div>
<div>
<span class="trending-category">Consumer</span>
<a class="article-link" href="article-battery-life-headline-feature.php"><h4 class="trending-title">Battery life is becoming a headline feature again</h4></a>
<div class="trending-meta">Sam Chen</div>
</div>
</div>
</div>
</div>
<div class="sidebar-promo">
<div class="sidebar-promo-label">INSIDE TECH</div>
<h4 class="sidebar-promo-title">Ready image areas, cleaner structure, and working interactions</h4>
<p class="sidebar-promo-text">This block stays visually consistent with the page and gives the sidebar a finished feel instead of looking empty.</p>
</div>
<div class="sidebar-section" data-filter-section="">
<h3 class="sidebar-heading">Editor's picks</h3>
<div>
<article class="sidebar-story filter-item card-linkable" data-article-url="article-meta-platform-consolidation.php" data-category="hardware" data-date="2026-02-23" data-search="Messenger website desktop Meta security ecosystem">
<span class="sidebar-category">Infrastructure</span>
<a class="article-link" href="article-meta-platform-consolidation.php"><h4 class="sidebar-title">Meta's Messenger change says a lot about platform consolidation</h4></a>
<div class="sidebar-meta">Sharona Nicole Semilla</div>
</article>
<article class="sidebar-story filter-item card-linkable" data-article-url="article-the-moon-is-also-a-mars-story.php" data-category="hardware" data-date="2026-02-23" data-search="Starship 5 fuel transfer Artemis Moon Mars">
<span class="sidebar-category">Space hardware</span>
<a class="article-link" href="article-the-moon-is-also-a-mars-story.php"><h4 class="sidebar-title">The Moon story is also a Mars story once refueling works</h4></a>
<div class="sidebar-meta">David Sutherland</div>
</article>
<article class="sidebar-story filter-item card-linkable" data-article-url="article-sovereign-ai-priority.php" data-category="science" data-date="2026-02-23" data-search="Sovereign AI Factory Australia Cisco NVIDIA">
<span class="sidebar-category">Security</span>
<a class="article-link" href="article-sovereign-ai-priority.php"><h4 class="sidebar-title">Sovereign AI infrastructure is turning into a serious national priority</h4></a>
<div class="sidebar-meta">Marcus Thompson</div>
</article>
</div>
</div>
</aside>
</div>
</div>
<div class="container">
<?php require_once 'category-approved-section.php'; renderApprovedCategorySection(getDB(), 'technology', ['title' => 'Approved technology articles', 'eyebrow' => 'Editorial review']); ?>
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
<script src="burger.js"></script>
<script src="theme.js"></script>
<script src="search.js"></script>
<script src="filter.js"></script>
<script src="interactions.js"></script>
<script src="editorial-tools.js"></script><script src="pulse-features.js"></script>
<script src="article-interactions.js"></script>
<script src="main-page-links.js"></script></body>
</html>
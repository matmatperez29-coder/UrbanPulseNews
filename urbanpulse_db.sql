-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2026 at 09:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urbanpulse_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `article_submissions`
--

CREATE TABLE `article_submissions` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` enum('technology','sports','entertainment','worldnews') NOT NULL,
  `summary` text NOT NULL,
  `body` longtext NOT NULL,
  `image_url` varchar(500) DEFAULT '',
  `status` enum('pending','approved','declined') DEFAULT 'pending',
  `decline_reason` text DEFAULT NULL,
  `submitted_at` datetime DEFAULT current_timestamp(),
  `reviewed_at` datetime DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_submissions`
--

INSERT INTO `article_submissions` (`id`, `author_id`, `title`, `category`, `summary`, `body`, `image_url`, `status`, `decline_reason`, `submitted_at`, `reviewed_at`, `reviewed_by`) VALUES
(1, 3, 'Test', 'technology', 'Test', 'test', '', 'declined', NULL, '2026-03-22 16:02:57', '2026-03-22 17:18:10', 3),
(2, 3, 'KayoBahala eliminates Kira Seira', 'sports', 'KayoBahala delivered a massive upset as the wildcard squad eliminated tournament favorites Kira Seira, completing a stunning run to secure a spot in the Grand Finals and shaking the entire competition.', 'In one of the most unexpected and electrifying runs of the tournament, KayoBahala, a team that entered through the wildcard stage, has officially eliminated tournament favorites Kira Seira, punching their ticket straight into the Grand Finals. What started as a low-expectation underdog story has now evolved into a full-blown statement: KayoBahala is not here to participate—they are here to win.\r\n\r\nFrom the very beginning of the series, KayoBahala showed zero signs of hesitation. Despite Kira Seira’s reputation for consistency, discipline, and mechanical dominance, the wildcard squad came in with a completely different energy—aggressive, unpredictable, and fearless. It was clear early on that KayoBahala wasn’t intimidated by names or past achievements.\r\n\r\nThe opening moments of the match already hinted at an upset. KayoBahala dictated the tempo, forcing Kira Seira into uncomfortable situations. Instead of playing reactively, they took control—winning early engagements, capitalizing on small mistakes, and snowballing their advantages with precision. Their coordination looked far from a wildcard team; it resembled a roster that had been preparing for this exact moment.\r\n\r\nKira Seira, known for their ability to adapt mid-series, tried to stabilize. There were flashes of brilliance—well-timed plays, clutch moments, and attempts to regain momentum—but every time they inched closer, KayoBahala shut them down. The wildcard team’s composure under pressure became the defining factor. No panic, no overextensions—just calculated aggression and confidence.\r\n\r\nOne of the most striking aspects of KayoBahala’s performance was their synergy. Every player stepped up exactly when needed. Whether it was securing crucial picks, anchoring defenses, or leading decisive pushes, their teamwork remained consistent throughout the series. This wasn’t a one-man carry—it was a full team effort, and it showed.\r\n\r\nAs the final moments approached, the pressure was at its peak. Kira Seira had one last chance to turn things around, but KayoBahala didn’t give them that opportunity. With a clean and decisive finish, they closed out the series, eliminating one of the strongest teams in the tournament and completing one of the biggest upsets so far.\r\n\r\nThe arena—or even just the viewers online—felt the shift. A wildcard team had just taken down a giant.\r\n\r\nNow, all eyes are on KayoBahala as they head into the Grand Finals. What makes their run even more dangerous is momentum. They’ve already proven they can beat top-tier opponents, and with their confidence at an all-time high, they’re entering the finals as more than just underdogs—they’re legitimate contenders.\r\n\r\nFor Kira Seira, the loss is a tough one. A team with championship expectations now exits earlier than anticipated. Still, their performance throughout the tournament cannot be overlooked, and this defeat will likely serve as fuel for future comebacks.\r\n\r\nBut for now, the spotlight belongs to KayoBahala.\r\n\r\nFrom wildcard entry to Grand Finals—this is the kind of storyline that defines tournaments.\r\n\r\nAnd if this run has proven anything, it’s this: never underestimate a team with nothing to lose.', '', 'approved', NULL, '2026-03-22 16:52:59', '2026-03-22 16:57:03', 3);

-- --------------------------------------------------------

--
-- Table structure for table `article_transcripts`
--

CREATE TABLE `article_transcripts` (
  `id` int(11) NOT NULL,
  `transcript_key` varchar(100) NOT NULL,
  `article_id` varchar(100) DEFAULT NULL,
  `page_slug` varchar(50) NOT NULL DEFAULT 'home',
  `eyebrow` varchar(120) NOT NULL,
  `headline` varchar(255) NOT NULL,
  `deck` text NOT NULL,
  `author` varchar(120) NOT NULL DEFAULT 'UrbanPulse Desk',
  `published_label` varchar(120) NOT NULL,
  `duration_label` varchar(50) NOT NULL DEFAULT '2 min read',
  `summary` text NOT NULL,
  `quote_text` text DEFAULT NULL,
  `signals_json` longtext NOT NULL,
  `transcript_json` longtext NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_transcripts`
--

INSERT INTO `article_transcripts` (`id`, `transcript_key`, `article_id`, `page_slug`, `eyebrow`, `headline`, `deck`, `author`, `published_label`, `duration_label`, `summary`, `quote_text`, `signals_json`, `transcript_json`, `is_active`, `created_at`) VALUES
(1, 'tech-agentic', 'article-ai-agentic-revolution', 'technology', 'AI and Robotics', 'Transcript Lens: The Transition to Agentic AI and Autonomous Systems', 'A spoken-style newsroom transcript that turns the article into a clean sequence of anchor notes, field context, and signal checks.', 'Aris Thorne', 'February 23, 2026 · 9:00 AM PST', '3 min read', 'UrbanPulse frames the shift to agentic AI as more than a feature upgrade. The core story is about what happens when software starts making chained decisions that affect logistics, operations, and accountability.', 'The question is no longer whether AI can act. The question is how humans stay meaningfully responsible when it does.', '[\"Trust architecture\",\"Human-on-the-loop\",\"Workflow delegation\"]', '[{\"speaker\":\"ANCHOR\",\"time\":\"00:00\",\"text\":\"Across companies, AI is moving from assistant mode into operator mode. These systems are starting to schedule tasks, route decisions, and complete multi-step work with less direct human prompting.\"},{\"speaker\":\"DESK NOTE\",\"time\":\"00:28\",\"text\":\"That shift sounds efficient, but it changes the risk. One fast mistake can now be repeated at scale because the machine is acting across an entire workflow instead of a single step.\"},{\"speaker\":\"FIELD REPORT\",\"time\":\"00:57\",\"text\":\"Executives say the value is speed and consistency. Critics say the hidden issue is traceability. If an agent makes ten connected choices, teams need to know where the judgment really came from.\"},{\"speaker\":\"ANCHOR\",\"time\":\"01:34\",\"text\":\"UrbanPulse reads this moment as a trust problem, not only a productivity story. Safety rules, escalation paths, and logging systems are becoming as important as the model itself.\"}]', 1, '2026-03-30 20:33:59'),
(2, 'sports-eagles', 'article-superbowl-lix', 'sports', 'American Football', 'Transcript Lens: Philadelphia Eagles Triumph in Super Bowl LIX', 'A fast, readable game-call transcript built for students and fans who want the rhythm of the night without scanning a full recap.', 'Marcus Thompson', 'February 9, 2025 · 6:30 PM EST', '3 min read', 'The transcript captures the defensive tone, the scoring momentum, and why the game ended the Chiefs’ push for a three-peat.', 'The Eagles did not just win the game. They changed the emotional weather of it before halftime.', '[\"Defensive pressure\",\"Momentum swing\",\"MVP path\"]', '[{\"speaker\":\"ANCHOR\",\"time\":\"00:00\",\"text\":\"From the opening stretch, Philadelphia looked sharper at the line and more comfortable controlling the pace.\"},{\"speaker\":\"GAME CALL\",\"time\":\"00:21\",\"text\":\"The turning point came when the Eagles created pressure without giving away space, forcing Kansas City into a more reactive game than usual.\"},{\"speaker\":\"DESK NOTE\",\"time\":\"00:49\",\"text\":\"Once the score tilted, the mood of the night changed. The Chiefs were chasing stability while the Eagles were playing with conviction.\"},{\"speaker\":\"ANCHOR\",\"time\":\"01:10\",\"text\":\"UrbanPulse reads the result as a complete-team win, with the MVP storyline fitting into a larger story about control and discipline.\"}]', 1, '2026-03-30 20:33:59'),
(3, 'sports-kayobahala', 'submission-2', 'sports', 'Esports / Tournament Desk', 'Transcript Lens: KayoBahala eliminates Kira Seira', 'A bracket-shock transcript mode that reframes the upset like a live desk recap with momentum beats and crowd energy.', 'UrbanPulse Tournament Desk', 'March 22, 2026 · 4:57 PM PHT', '3 min read', 'This transcript converts your approved sports article into a cleaner spoken rundown so readers can follow the wildcard run faster on mobile.', 'From wildcard entry to Grand Finals, this is the kind of storyline that defines tournaments.', '[\"Wildcard momentum\",\"Upset alert\",\"Grand Finals\"]', '[{\"speaker\":\"ANCHOR\",\"time\":\"00:00\",\"text\":\"A wildcard team just turned the bracket upside down. KayoBahala eliminated tournament favorite Kira Seira and booked a place in the Grand Finals.\"},{\"speaker\":\"MATCH DESK\",\"time\":\"00:24\",\"text\":\"The key pattern was confidence without panic. KayoBahala controlled early exchanges, punished mistakes, and kept the pace uncomfortable for Kira Seira all series long.\"},{\"speaker\":\"ARENA NOTE\",\"time\":\"00:52\",\"text\":\"Each time Kira Seira looked ready to recover, KayoBahala answered with composure. The upset stopped feeling lucky and started feeling earned.\"},{\"speaker\":\"ANCHOR\",\"time\":\"01:18\",\"text\":\"UrbanPulse reads this as a momentum story. KayoBahala is not arriving in the finals as a cute underdog. They are arriving as a threat.\"}]', 1, '2026-03-30 20:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `body` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `article_id`, `parent_id`, `body`, `likes`, `created_at`) VALUES
(1, 1, 'article-gpt6-beta', NULL, 'test', 2, '2026-03-22 08:41:31'),
(2, 2, 'article-gpt6-beta', NULL, 'test', 0, '2026-03-22 08:42:51'),
(3, 1, 'view-article', NULL, 'this is so cool', 1, '2026-03-22 17:12:13'),
(4, 2, 'article-cinema-renaissance', NULL, 'test', 1, '2026-04-03 13:51:46'),
(5, 1, 'article-ai-agentic-revolution', NULL, 'test', 0, '2026-04-16 02:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_likes`
--

INSERT INTO `comment_likes` (`user_id`, `comment_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 4);


-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `recipient_user_id` int(11) NOT NULL,
  `actor_user_id` int(11) NOT NULL,
  `type` enum('comment_reply','comment_like','article_comment','article_reaction') NOT NULL,
  `article_id` varchar(100) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `reaction` varchar(20) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pulse_alerts`
--

CREATE TABLE `pulse_alerts` (
  `id` int(11) NOT NULL,
  `alert_key` varchar(100) NOT NULL,
  `page_scope` varchar(255) NOT NULL DEFAULT 'home',
  `category` varchar(100) NOT NULL,
  `label` varchar(120) NOT NULL,
  `headline` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `event_time` datetime NOT NULL DEFAULT current_timestamp(),
  `transcript_id` varchar(100) DEFAULT NULL,
  `action_text` varchar(80) NOT NULL DEFAULT 'Open transcript',
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pulse_alerts`
--

INSERT INTO `pulse_alerts` (`id`, `alert_key`, `page_scope`, `category`, `label`, `headline`, `summary`, `event_time`, `transcript_id`, `action_text`, `is_active`) VALUES
(1, 'alert_agentic_shift', 'home,technology', 'AI Desk', 'New transcript lens', 'Agentic AI coverage now tracks trust, safety, and workflow ownership in one transcript lens.', 'The technology desk stitched the story into a readable timeline with anchor notes, field context, and quick signals.', '2026-03-25 08:20:00', 'tech-agentic', 'Open transcript', 1),
(2, 'alert_eagles_film_room', 'home,sports', 'Sports Desk', 'Film room', 'The Eagles Super Bowl story now has a play-by-play transcript mode.', 'Open the transcript lens to see the scoring swing, pressure points, and the MVP angle in sequence.', '2026-03-25 07:42:00', 'sports-eagles', 'Open recap', 1),
(3, 'alert_kayobahala_upset', 'home,sports', 'Tournament Wire', 'Bracket shock', 'Your approved KayoBahala story now has an AI transcript lens built for quick reading.', 'This one uses your real approved sports submission and turns it into a clean match-call transcript for mobile readers.', '2026-03-25 09:10:00', 'sports-kayobahala', 'Open upset lens', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` varchar(100) NOT NULL,
  `reaction` enum('happy','sad','surprised','angry') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`id`, `user_id`, `article_id`, `reaction`, `created_at`) VALUES
(2, 2, 'article-ai-agentic-revolution', 'angry', '2026-03-22 16:35:23'),
(3, 1, 'article-ai-agentic-revolution', 'sad', '2026-03-22 16:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('reader','author','admin') DEFAULT 'reader',
  `avatar_color` varchar(7) DEFAULT '#c8102e',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `role`, `avatar_color`, `created_at`) VALUES
(1, 'matmat', 'matmatperez29@gmail.com', '$2y$10$gbmySswF7OcqbDFtKSN8C.aIftt8tTTwSY3AW22AemHFegq8.rm4G', 'Matthew Asiao Perez', 'reader', '#9b59b6', '2026-03-20 18:55:01'),
(2, 'akosinimo', 'findingnimo@gmail.com', '$2y$10$xbksnfxTwm2pYOipvtcQHushQK4ikLte1fHF58uIdfjw5YVP6PZ9a', 'Cristel Ann Nimo', 'reader', '#e67e22', '2026-03-22 08:42:14'),
(3, 'author1', 'author1@urbanpulse.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sample Author', 'admin', '#0066cc', '2026-03-22 16:01:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article_submissions`
--
ALTER TABLE `article_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `reviewed_by` (`reviewed_by`);

--
-- Indexes for table `article_transcripts`
--
ALTER TABLE `article_transcripts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transcript_key` (`transcript_key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`user_id`,`comment_id`),
  ADD KEY `comment_id` (`comment_id`);


--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient_user_id` (`recipient_user_id`),
  ADD KEY `actor_user_id` (`actor_user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `pulse_alerts`
--
ALTER TABLE `pulse_alerts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alert_key` (`alert_key`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_reaction` (`user_id`,`article_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article_submissions`
--
ALTER TABLE `article_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `article_transcripts`
--
ALTER TABLE `article_transcripts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pulse_alerts`
--
ALTER TABLE `pulse_alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article_submissions`
--
ALTER TABLE `article_submissions`
  ADD CONSTRAINT `article_submissions_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_submissions_ibfk_2` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD CONSTRAINT `comment_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_likes_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;


--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`recipient_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`actor_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`parent_comment_id`) REFERENCES `comments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `reactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

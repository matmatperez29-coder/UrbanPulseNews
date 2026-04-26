-- ============================================
-- Run this in phpMyAdmin → urbanpulse_db → SQL
-- ============================================

-- Step 1: Add author/admin roles if needed
ALTER TABLE users
MODIFY COLUMN role ENUM('reader','author','admin') DEFAULT 'reader';

-- Step 2: Create article submissions table
CREATE TABLE IF NOT EXISTS article_submissions (
  id             INT AUTO_INCREMENT PRIMARY KEY,
  author_id      INT NOT NULL,
  title          VARCHAR(255) NOT NULL,
  category       ENUM('technology','sports','entertainment','worldnews') NOT NULL,
  summary        TEXT NOT NULL,
  body           LONGTEXT NOT NULL,
  image_url      VARCHAR(500) DEFAULT '',
  status         ENUM('pending','approved','declined') DEFAULT 'pending',
  decline_reason TEXT DEFAULT NULL,
  submitted_at   DATETIME DEFAULT NOW(),
  reviewed_at    DATETIME DEFAULT NULL,
  reviewed_by    INT DEFAULT NULL,
  FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (reviewed_by) REFERENCES users(id) ON DELETE SET NULL
);

-- Step 3: Upgrade comments so replies work
ALTER TABLE comments
  ADD COLUMN IF NOT EXISTS parent_id INT NULL AFTER article_id;

ALTER TABLE comments
  ADD CONSTRAINT comments_ibfk_2 FOREIGN KEY (parent_id) REFERENCES comments(id) ON DELETE CASCADE;

-- Step 4: Create notifications table
CREATE TABLE IF NOT EXISTS notifications (
  id                INT AUTO_INCREMENT PRIMARY KEY,
  recipient_user_id INT NOT NULL,
  actor_user_id     INT NOT NULL,
  type              ENUM('comment_reply','comment_like','article_reaction') NOT NULL,
  article_id        VARCHAR(100) DEFAULT NULL,
  comment_id        INT DEFAULT NULL,
  parent_comment_id INT DEFAULT NULL,
  reaction          VARCHAR(20) DEFAULT NULL,
  is_read           TINYINT(1) NOT NULL DEFAULT 0,
  created_at        DATETIME DEFAULT NOW(),
  KEY recipient_user_id (recipient_user_id),
  KEY actor_user_id (actor_user_id),
  KEY comment_id (comment_id),
  CONSTRAINT notifications_ibfk_1 FOREIGN KEY (recipient_user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT notifications_ibfk_2 FOREIGN KEY (actor_user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT notifications_ibfk_3 FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE SET NULL,
  CONSTRAINT notifications_ibfk_4 FOREIGN KEY (parent_comment_id) REFERENCES comments(id) ON DELETE SET NULL
);

-- Step 5: Make your chosen account an admin if needed
UPDATE users SET role = 'admin' WHERE username = 'admin';

-- Step 6: Optional sample author account
INSERT IGNORE INTO users (username, email, password, name, role, avatar_color) VALUES
('author1', 'author1@urbanpulse.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sample Author', 'author', '#0066cc');
-- Default password for author1: password

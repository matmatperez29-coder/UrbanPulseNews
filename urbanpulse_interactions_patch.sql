-- ============================================
-- UrbanPulse interactions patch
-- Run this in phpMyAdmin → urbanpulse_db → SQL
-- Adds: comment replies + account notifications
-- ============================================

ALTER TABLE comments
  ADD COLUMN IF NOT EXISTS parent_id INT NULL AFTER article_id;

SET @has_comments_parent_fk := (
  SELECT COUNT(*)
  FROM information_schema.TABLE_CONSTRAINTS
  WHERE CONSTRAINT_SCHEMA = DATABASE()
    AND TABLE_NAME = 'comments'
    AND CONSTRAINT_NAME = 'comments_ibfk_2'
);
SET @sql_comments_parent_fk := IF(
  @has_comments_parent_fk = 0,
  'ALTER TABLE comments ADD CONSTRAINT comments_ibfk_2 FOREIGN KEY (parent_id) REFERENCES comments(id) ON DELETE CASCADE',
  'SELECT 1'
);
PREPARE stmt_comments_parent_fk FROM @sql_comments_parent_fk;
EXECUTE stmt_comments_parent_fk;
DEALLOCATE PREPARE stmt_comments_parent_fk;

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
  created_at        DATETIME DEFAULT CURRENT_TIMESTAMP,
  KEY recipient_user_id (recipient_user_id),
  KEY actor_user_id (actor_user_id),
  KEY comment_id (comment_id),
  CONSTRAINT notifications_ibfk_1 FOREIGN KEY (recipient_user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT notifications_ibfk_2 FOREIGN KEY (actor_user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT notifications_ibfk_3 FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE SET NULL,
  CONSTRAINT notifications_ibfk_4 FOREIGN KEY (parent_comment_id) REFERENCES comments(id) ON DELETE SET NULL
);

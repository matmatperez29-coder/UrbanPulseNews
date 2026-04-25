/* ============================================================
   article-interactions.js — UrbanPulse
   Handles: reactions, comments, replies, article submit CTA, shares
============================================================ */
(() => {
  'use strict';

  const ARTICLE_ID = (typeof UP_ARTICLE_ID !== 'undefined' && UP_ARTICLE_ID) ? UP_ARTICLE_ID : location.pathname.split('/').pop().replace('.php', '');
  const state = { reactions: {}, comments: [], myReaction: null, myLikes: [], isLoggedIn: false };
  let deleteModalInstance = null;

  function initials(name) {
    if (!name) return '??';
    return name.trim().split(/\s+/).map(w => w[0]).join('').slice(0, 2).toUpperCase();
  }

  function timeAgo(dateString) {
    const ts = new Date(dateString).getTime();
    const m = Math.floor((Date.now() - ts) / 60000);
    if (m < 1) return 'Just now';
    if (m < 60) return `${m}m ago`;
    const h = Math.floor(m / 60);
    if (h < 24) return `${h}h ago`;
    const d = Math.floor(h / 24);
    if (d < 7) return `${d}d ago`;
    return new Date(ts).toLocaleDateString('en-PH', { month: 'short', day: 'numeric' });
  }

  function esc(str) {
    if (!str) return '';
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;');
  }


  function ensureDeleteModal() {
    if (deleteModalInstance) return deleteModalInstance;

    const overlay = document.createElement('div');
    overlay.className = 'comment-delete-modal';
    overlay.innerHTML = `
      <div class="comment-delete-dialog" role="dialog" aria-modal="true" aria-labelledby="commentDeleteTitle">
        <div class="comment-delete-icon" aria-hidden="true">🗑</div>
        <h3 id="commentDeleteTitle">Delete comment?</h3>
        <p>This will permanently remove the comment from the article discussion.</p>
        <div class="comment-delete-actions">
          <button type="button" class="comment-delete-cancel">Cancel</button>
          <button type="button" class="comment-delete-confirm">Delete</button>
        </div>
      </div>
    `;
    document.body.appendChild(overlay);

    const cancelBtn = overlay.querySelector('.comment-delete-cancel');
    const confirmBtn = overlay.querySelector('.comment-delete-confirm');
    let resolver = null;

    function close(result) {
      overlay.classList.remove('is-open');
      document.body.classList.remove('delete-modal-open');
      document.removeEventListener('keydown', onKeydown);
      if (resolver) {
        resolver(result);
        resolver = null;
      }
    }

    function onKeydown(event) {
      if (event.key === 'Escape') close(false);
    }

    overlay.addEventListener('click', event => {
      if (event.target === overlay) close(false);
    });
    cancelBtn.addEventListener('click', () => close(false));
    confirmBtn.addEventListener('click', () => close(true));

    deleteModalInstance = {
      open() {
        overlay.classList.add('is-open');
        document.body.classList.add('delete-modal-open');
        document.addEventListener('keydown', onKeydown);
        cancelBtn.focus();
        return new Promise(resolve => {
          resolver = resolve;
        });
      }
    };

    return deleteModalInstance;
  }

  function normalizeReadMoreLayout(root = document) {
    const selectors = '.read-more-btn';
    root.querySelectorAll(selectors).forEach(button => {
      if (button.dataset.layoutFixed === 'true') return;
      const card = button.closest('.filter-item, .news-card, .review-card, .list-story, .compact-story, .sidebar-story, .hero-article, .hero-main, .sport-main, .story-card, .category-card, .more-card, .trending-item, .globe-card, .featured-side-item');
      if (!card) return;
      const anchor = card.querySelector('.story-meta, .hero-meta, .sidebar-meta, .compact-meta, .news-card-meta, .review-meta, .trending-meta, .time-tag, .globe-meta, .featured-meta');
      const panelId = button.dataset.detailTarget || button.getAttribute('data-read-more');
      const panel = panelId ? document.getElementById(panelId) : null;
      if (panel && panel.parentElement !== button.parentElement && anchor && anchor.parentNode) {
        anchor.parentNode.insertBefore(panel, anchor.nextSibling);
      }
      if (anchor && button.parentElement !== anchor.parentElement.nextSibling) {
        anchor.insertAdjacentElement('afterend', button);
      }
      button.dataset.layoutFixed = 'true';
    });
  }

  function ensureNotificationAssets() {
    if (!document.querySelector('link[href="user-notifications.css"]')) {
      const link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = 'user-notifications.css';
      document.head.appendChild(link);
    }
    if (!window.UPNotificationsLoaded && !document.querySelector('script[src="user-notifications.js"]')) {
      const script = document.createElement('script');
      script.src = 'user-notifications.js';
      document.body.appendChild(script);
    }
  }

  async function fetchInteractions() {
    try {
      const res = await fetch(`api.php?action=get_data&article_id=${encodeURIComponent(ARTICLE_ID)}`);
      const data = await res.json();
      if (!data || data.error) return;
      state.reactions = data.reactions || {};
      state.comments = Array.isArray(data.comments) ? data.comments : [];
      state.myReaction = data.myReaction || null;
      state.myLikes = Array.isArray(data.myLikes) ? data.myLikes.map(Number) : [];
      state.isLoggedIn = !!data.isLoggedIn;
      renderReactions();
      renderComments();
    } catch (err) {
      console.error('Failed to load interactions:', err);
    }
  }

  function renderReactions() {
    const container = document.querySelector('.reaction-buttons');
    if (!container) return;

    const reactions = [
      { key: 'happy', emoji: '😊', label: 'Happy' },
      { key: 'sad', emoji: '😢', label: 'Sad' },
      { key: 'surprised', emoji: '😮', label: 'Surprised' },
      { key: 'angry', emoji: '😠', label: 'Angry' },
    ];

    container.innerHTML = reactions.map(r => {
      const count = Number(state.reactions[r.key] || 0);
      const active = state.myReaction === r.key ? 'active' : '';
      return `<button class="reaction-btn ${active}" data-key="${r.key}">
        <span class="emoji">${r.emoji}</span>
        <span class="label">${r.label}</span>
        <span class="count">${count > 0 ? count : ''}</span>
      </button>`;
    }).join('');

    container.querySelectorAll('.reaction-btn').forEach(btn => {
      btn.addEventListener('click', async () => {
        if (!state.isLoggedIn) {
          alert('Please log in to leave a reaction!');
          window.location.href = 'login.php';
          return;
        }

        const key = btn.dataset.key;
        try {
          const res = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'toggle_reaction', article_id: ARTICLE_ID, reaction: key })
          });
          const result = await res.json();
          if (!result.success) {
            alert(result.error || 'Failed to save reaction.');
            return;
          }
          await fetchInteractions();
        } catch (error) {
          console.error('Reaction error:', error);
        }
      });
    });
  }

  function buildCommentTree() {
    const topLevel = [];
    const repliesByParent = new Map();

    state.comments.forEach(comment => {
      comment.id = Number(comment.id);
      comment.parent_id = comment.parent_id ? Number(comment.parent_id) : null;
      comment.user_id = Number(comment.user_id);
      comment.likes = Number(comment.likes || 0);
      if (comment.parent_id) {
        if (!repliesByParent.has(comment.parent_id)) repliesByParent.set(comment.parent_id, []);
        repliesByParent.get(comment.parent_id).push(comment);
      } else {
        topLevel.push(comment);
      }
    });

    topLevel.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
    repliesByParent.forEach(list => list.sort((a, b) => new Date(a.created_at) - new Date(b.created_at)));
    return { topLevel, repliesByParent };
  }

  function commentActions(comment, isReply = false) {
    const isLiked = state.myLikes.includes(Number(comment.id));
    const isAdmin = typeof UP_IS_ADMIN !== 'undefined' && !!UP_IS_ADMIN;
    const isOwner = typeof UP_CURRENT_USER_ID !== 'undefined' && UP_CURRENT_USER_ID !== null && Number(UP_CURRENT_USER_ID) === Number(comment.user_id);
    return `
      <div class="comment-actions-row">
        <button class="comment-like-btn ${isLiked ? 'liked' : ''}" data-id="${comment.id}">
          👍 ${comment.likes > 0 ? comment.likes : ''} Like
        </button>
        ${!isReply ? `<button class="comment-reply-btn" data-id="${comment.id}">↩ Reply</button>` : ''}
        ${(isAdmin || isOwner) ? `<button class="comment-delete-btn" data-id="${comment.id}">🗑 Delete</button>` : ''}
      </div>
    `;
  }

  function replyComposer(parentId) {
    if (!state.isLoggedIn) return '';
    return `
      <form class="reply-form" data-parent-id="${parentId}" hidden>
        <textarea class="reply-text" maxlength="500" placeholder="Write your reply..."></textarea>
        <div class="reply-form-actions">
          <button type="submit" class="comment-submit">Post Reply</button>
          <button type="button" class="reply-cancel-btn">Cancel</button>
        </div>
      </form>
    `;
  }

  function renderCommentItem(comment, repliesByParent, isReply = false) {
    const replies = !isReply ? (repliesByParent.get(comment.id) || []) : [];
    return `
      <div class="comment-item ${isReply ? 'reply-item' : ''}" id="comment-${comment.id}" data-id="${comment.id}">
        <div class="comment-avatar" style="background:${comment.avatar_color};">${initials(comment.name)}</div>
        <div class="comment-body-wrap">
          <div class="comment-header">
            <div>
              <span class="comment-name">${esc(comment.name)}</span>
              <span class="comment-time">${timeAgo(comment.created_at)}</span>
            </div>
          </div>
          <div class="comment-text">${esc(comment.text).replace(/\n/g, '<br>')}</div>
          ${commentActions(comment, isReply)}
          ${!isReply ? replyComposer(comment.id) : ''}
          ${replies.length ? `<div class="reply-thread">${replies.map(reply => renderCommentItem(reply, repliesByParent, true)).join('')}</div>` : ''}
        </div>
      </div>
    `;
  }

  function renderComments() {
    const list = document.getElementById('commentList');
    const badge = document.querySelector('.comment-count-badge');
    if (!list) return;

    if (badge) {
      badge.textContent = state.comments.length;
      badge.style.display = state.comments.length ? '' : 'none';
    }

    const { topLevel, repliesByParent } = buildCommentTree();
    if (!topLevel.length) {
      list.innerHTML = '<div class="comment-empty">No comments yet — be the first!</div>';
      return;
    }

    list.innerHTML = topLevel.map(comment => renderCommentItem(comment, repliesByParent, false)).join('');

    list.querySelectorAll('.comment-like-btn').forEach(btn => {
      btn.addEventListener('click', async () => {
        if (!state.isLoggedIn) {
          alert('Please log in to like a comment!');
          window.location.href = 'login.php';
          return;
        }
        const commentId = Number(btn.dataset.id);
        try {
          const res = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'toggle_like', article_id: ARTICLE_ID, comment_id: commentId })
          });
          const result = await res.json();
          if (!result.success) {
            alert(result.error || 'Failed to update like.');
            return;
          }
          await fetchInteractions();
        } catch (error) {
          console.error('Like error:', error);
        }
      });
    });

    list.querySelectorAll('.comment-reply-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        if (!state.isLoggedIn) {
          alert('Please log in to reply to a comment!');
          window.location.href = 'login.php';
          return;
        }
        const parent = btn.closest('.comment-body-wrap');
        const form = parent?.querySelector('.reply-form');
        if (!form) return;
        const isHidden = form.hasAttribute('hidden');
        document.querySelectorAll('.reply-form').forEach(el => el.setAttribute('hidden', 'hidden'));
        if (isHidden) {
          form.removeAttribute('hidden');
          const input = form.querySelector('.reply-text');
          if (input) input.focus();
        }
      });
    });

    list.querySelectorAll('.reply-cancel-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const form = btn.closest('.reply-form');
        if (!form) return;
        form.reset();
        form.setAttribute('hidden', 'hidden');
      });
    });

    list.querySelectorAll('.reply-form').forEach(form => {
      form.addEventListener('submit', async event => {
        event.preventDefault();
        const textarea = form.querySelector('.reply-text');
        const parentId = Number(form.dataset.parentId);
        const body = textarea?.value.trim() || '';
        if (!body) return;

        const submit = form.querySelector('.comment-submit');
        if (submit) {
          submit.disabled = true;
          submit.textContent = 'Posting...';
        }

        try {
          const res = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'add_comment', article_id: ARTICLE_ID, body, parent_id: parentId })
          });
          const result = await res.json();
          if (!result.success) {
            alert(result.error || 'Failed to post reply.');
          } else {
            form.reset();
            form.setAttribute('hidden', 'hidden');
            await fetchInteractions();
          }
        } catch (error) {
          console.error('Reply error:', error);
        } finally {
          if (submit) {
            submit.disabled = false;
            submit.textContent = 'Post Reply';
          }
        }
      });
    });

    list.querySelectorAll('.comment-delete-btn').forEach(btn => {
      btn.addEventListener('click', async () => {
        const commentId = Number(btn.dataset.id);
        const confirmed = await ensureDeleteModal().open();
        if (!confirmed) return;
        try {
          const res = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'delete_comment', article_id: ARTICLE_ID, comment_id: commentId })
          });
          const result = await res.json();
          if (!result.success) {
            alert(result.error || 'Failed to delete comment.');
            return;
          }
          await fetchInteractions();
        } catch (error) {
          console.error('Delete error:', error);
        }
      });
    });
  }

  function initCommentsForm() {
    const form = document.getElementById('commentForm');
    const textarea = document.getElementById('commentText');
    const submitBtn = form?.querySelector('.comment-submit');
    const charEl = document.getElementById('charCount');
    const MAX = 500;
    if (!form || !textarea) return;

    textarea.addEventListener('input', () => {
      const left = MAX - textarea.value.length;
      if (charEl) {
        charEl.textContent = `${left} characters remaining`;
        charEl.style.color = left < 0 ? 'var(--color-secondary)' : (left < 50 ? '#d97706' : 'var(--color-text-muted)');
      }
    });

    form.addEventListener('submit', async e => {
      e.preventDefault();
      if (!state.isLoggedIn) return;
      const text = textarea.value.trim();
      if (!text || text.length > MAX) return;

      submitBtn.disabled = true;
      submitBtn.textContent = 'Posting...';
      try {
        const res = await fetch('api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ action: 'add_comment', article_id: ARTICLE_ID, body: text })
        });
        const result = await res.json();
        if (!result.success) {
          alert(result.error || 'Failed to post comment.');
        } else {
          form.reset();
          if (charEl) charEl.textContent = `${MAX} characters remaining`;
          await fetchInteractions();
        }
      } catch (error) {
        console.error('Comment error:', error);
      } finally {
        submitBtn.textContent = 'Post Comment';
        submitBtn.disabled = false;
      }
    });
  }

  function initShare() {
    const url = encodeURIComponent(location.href);
    const title = encodeURIComponent(document.title);

    document.querySelectorAll('.share-btn').forEach(btn => {
      if (btn.classList.contains('fb')) {
        btn.href = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
        btn.target = '_blank';
        btn.rel = 'noopener';
      }
      if (btn.classList.contains('tw')) {
        btn.href = `https://twitter.com/intent/tweet?text=${title}&url=${url}`;
        btn.target = '_blank';
        btn.rel = 'noopener';
      }
      if (btn.classList.contains('copy')) {
        btn.addEventListener('click', async () => {
          try {
            await navigator.clipboard.writeText(location.href);
          } catch {
            const t = document.createElement('textarea');
            t.value = location.href;
            document.body.appendChild(t);
            t.select();
            document.execCommand('copy');
            t.remove();
          }
          btn.classList.add('copied');
          btn.textContent = '✓ Copied!';
          const toast = document.querySelector('.share-toast');
          if (toast) {
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2000);
          }
          setTimeout(() => {
            btn.classList.remove('copied');
            btn.innerHTML = '🔗 Copy Link';
          }, 2000);
        });
      }
    });
  }

  function injectSubmitCTA() {
    const commentsSection = document.querySelector('.comments-section');
    if (!commentsSection || document.querySelector('.article-submit-cta')) return;
    const cta = document.createElement('div');
    cta.className = 'article-submit-cta';
    cta.innerHTML = `
      <div>
        <div class="article-submit-eyebrow">UrbanPulse Contributors</div>
        <h3>Want to submit an article?</h3>
        <p>Write your story and send it for admin approval. Click below to open the contributor submission page.</p>
      </div>
      <a href="submit-article.php" class="article-submit-link">Click here</a>
    `;
    commentsSection.parentNode.insertBefore(cta, commentsSection);
  }

  document.addEventListener('DOMContentLoaded', () => {
    ensureNotificationAssets();
    injectSubmitCTA();
    normalizeReadMoreLayout();
    fetchInteractions();
    initCommentsForm();
    initShare();
  });
})();

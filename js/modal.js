/* Lightweight modal system: post content + Vimeo lightbox */
(function () {
  "use strict";

  /**
   * Utilities
   */
  function qs(selector, scope) {
    return (scope || document).querySelector(selector);
  }
  function qsa(selector, scope) {
    return Array.prototype.slice.call((scope || document).querySelectorAll(selector));
  }

  var modal = document.querySelector(".custom-modal");
  if (!modal) {
    modal = document.createElement("div");
    modal.className = "custom-modal";
    modal.setAttribute("role", "dialog");
    modal.setAttribute("aria-modal", "true");
    modal.innerHTML = `
      <div class="custom-modal-box" data-modal-box>
        <button type="button" class="custom-modal-close" aria-label="Close">&#x2715;</button>
        <div class="custom-modal-content" data-modal-content></div>
      </div>
    `;
  }

  let isOpen = false;
  let lastFocused = null;

  function openModal() {
    if (isOpen) return;
    document.body.appendChild(modal);
    document.body.classList.add("modal-open");
    modal.classList.add("active");
    isOpen = true;
    lastFocused = document.activeElement;
    // Focus close button for accessibility
    const closeBtn = qs(".custom-modal-close", modal);
    if (closeBtn) closeBtn.focus();
    document.addEventListener("keydown", onKeydown);
  }

  function closeModal() {
    if (!isOpen) return;
    modal.classList.remove("active");
    document.body.classList.remove("modal-open");
    // Cleanup dynamic content (e.g., video iframe)
    const content = qs("[data-modal-content]", modal);
    if (content) content.innerHTML = "";
    // Remove from DOM to avoid conflicts
    if (modal.parentNode) modal.parentNode.removeChild(modal);
    isOpen = false;
    document.removeEventListener("keydown", onKeydown);
    if (lastFocused && lastFocused.focus) lastFocused.focus();
  }

  function onKeydown(e) {
    if (e.key === "Escape") {
      closeModal();
    }
  }

  // Close via overlay or button
  modal.addEventListener("click", function (e) {
    const isOutside = e.target === modal;
    const isCloseBtn = e.target.closest && e.target.closest(".custom-modal-close");
    if (isOutside || isCloseBtn) {
      closeModal();
    }
  });

  /**
   * Content injectors
   */
  async function loadPostIntoModal(postId, postType) {
    const contentEl = qs("[data-modal-content]", modal);
    if (!contentEl) return;
    contentEl.innerHTML = `<div class="p-6"><div class="text-gray-500 text-sm">Loading…</div></div>`;

    // Resolve API root robustly
    var apiRootLink = document.querySelector('link[rel="https://api.w.org/"]');
    var apiRoot = apiRootLink && apiRootLink.href ? apiRootLink.href.replace(/\/$/, '') : (typeof window.wpApiSettings !== 'undefined' && window.wpApiSettings.root ? String(window.wpApiSettings.root).replace(/\/$/, '') : (window.location.origin + '/wp-json'));

    // Normalize post type
    var type = (postType || 'posts').toLowerCase();
    if (type === 'post') type = 'posts';

    var url = `${apiRoot}/wp/v2/${type}/${postId}?_embed=1`;

    // eslint-disable-next-line no-console
    console.log('[modal] Fetching', { postId: String(postId), postType: type, url: url });

    try {
      const response = await fetch(url, { credentials: 'same-origin' });
      if (!response.ok) {
        const bodyText = await response.text().catch(function () { return ''; });
        // eslint-disable-next-line no-console
        console.error('[modal] Response not OK', { status: response.status, statusText: response.statusText, body: bodyText });
        throw new Error('Fetch failed');
      }
      const post = await response.json();

      var title = post && post.title && post.title.rendered ? post.title.rendered : 'Untitled';
      var bodyHtml = (post && post.content && post.content.rendered) ? post.content.rendered : '';
      if (!bodyHtml || bodyHtml.trim() === '') {
        bodyHtml = (post && post.excerpt && post.excerpt.rendered) ? post.excerpt.rendered : '<p>No content available.</p>';
      }

      // Featured image via _embed
      var thumb = '';
      try {
        var mediaArr = post && post._embedded && post._embedded['wp:featuredmedia'] ? post._embedded['wp:featuredmedia'] : null;
        var media = mediaArr && mediaArr[0] ? mediaArr[0] : null;
        var imgUrl = media && media.source_url ? media.source_url : '';
        if (imgUrl) {
          thumb = `<img src="${imgUrl}" alt="" style="max-width:100%;height:auto;border-radius:6px;margin-bottom:16px;"/>`;
        }
      } catch (e) {
        // eslint-disable-next-line no-console
        console.warn('[modal] No featured image found');
      }

      contentEl.innerHTML = `
        <article class="prose max-w-none p-6">
          <h2 class="text-2xl font-semibold mb-4">${title}</h2>
          ${thumb}
          <div class="entry-content">${bodyHtml}</div>
        </article>
      `;
    } catch (err) {
      contentEl.innerHTML = `<div class="p-6 text-red-600">Failed to load. Please try again.</div>`;
      // eslint-disable-next-line no-console
      console.error('[modal] Fetch error', err);
    }
  }

  function loadVimeoIntoModal(vimeoId) {
    const contentEl = qs("[data-modal-content]", modal);
    if (!contentEl) return;
    const src = `https://player.vimeo.com/video/${vimeoId}?autoplay=1&muted=0&title=0&byline=0&portrait=0`;
    const iframe = document.createElement("iframe");
    iframe.setAttribute("src", src);
    iframe.setAttribute("allow", "autoplay; fullscreen; picture-in-picture");
    iframe.setAttribute("allowfullscreen", "");
    iframe.style.width = "100%";
    iframe.style.height = "56.25vw"; // 16:9 responsive via viewport width
    iframe.style.maxHeight = "80vh";
    iframe.style.maxWidth = "1280px";
    iframe.style.aspectRatio = "16/9";
    iframe.style.border = "0";
    contentEl.innerHTML = "";
    contentEl.appendChild(iframe);
  }

  /**
   * Trigger handling
   */
  function handlePostTriggerClick(e) {
    const btn = e.currentTarget;
    const postId = btn.getAttribute("data-post-id");
    const postType = btn.getAttribute("data-post-type") || 'posts';
    // eslint-disable-next-line no-console
    console.log('[modal] Trigger clicked', { postId: postId, postType: postType });
    if (!postId) return;
    openModal();
    loadPostIntoModal(postId, postType);
  }

  function handleVimeoTriggerClick(e) {
    const btn = e.currentTarget;
    const vimeoId = btn.getAttribute("data-vimeo-id");
    if (!vimeoId) return;
    openModal();
    loadVimeoIntoModal(vimeoId);
  }

  function bindTriggers(root) {
    qsa(".open-post-modal", root).forEach(function (el) {
      el.addEventListener("click", function (e) {
        e.preventDefault();
        handlePostTriggerClick(e);
      });
    });

    qsa(".open-video-lightbox", root).forEach(function (el) {
      el.addEventListener("click", function (e) {
        e.preventDefault();
        handleVimeoTriggerClick(e);
      });
    });
  }

  // Initial bind + observe DOM changes (Elementor or dynamic content)
  bindTriggers(document);
  const observer = new MutationObserver(function (mutations) {
    for (var i = 0; i < mutations.length; i++) {
      const m = mutations[i];
      if (m.addedNodes && m.addedNodes.length) {
        m.addedNodes.forEach(function (node) {
          if (node.nodeType === 1) {
            bindTriggers(node);
          }
        });
      }
    }
  });
  observer.observe(document.documentElement || document.body, { childList: true, subtree: true });
})();



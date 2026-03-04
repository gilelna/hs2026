// main.js

/* ===========================
   Transcript Modal Logic (per instance)
   =========================== */
document.addEventListener("click", function (e) {
  // Open
  const openBtn = e.target.closest(".transcript-box-btn");
  if (openBtn) {
    const box = openBtn.closest(".transcript-box");
    if (!box) return;
    const overlay = box.querySelector(".transcript-overlay");
    if (overlay) {
      overlay.classList.add("is-open");
      document.body.classList.add("modal-open");
    }
    return;
  }

  // Close via X button
  const closeBtn = e.target.closest(".transcript-close");
  if (closeBtn) {
    const overlay = closeBtn.closest(".transcript-overlay");
    if (overlay) overlay.classList.remove("is-open");
    if (!document.querySelector('.transcript-overlay.is-open')) {
      document.body.classList.remove("modal-open");
    }
    return;
  }

  // Click outside modal (overlay background)
  if (e.target.classList && e.target.classList.contains("transcript-overlay")) {
    e.target.classList.remove("is-open");
    if (!document.querySelector('.transcript-overlay.is-open')) {
      document.body.classList.remove("modal-open");
    }
    return;
  }
});

// Close on Escape key
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    document.querySelectorAll('.transcript-overlay.is-open').forEach(function (ov) {
      ov.classList.remove('is-open');
    });
    document.body.classList.remove('modal-open');
  }
});

 // Function to open transcript in a new window/tab
function hsTranscriptOpen(postId) {
  const transcriptContent = document.querySelector(`#transcript-content-${postId}`);
  if (!transcriptContent) {
    alert("Transcript content not found.");
    return;
  }
  const newWindow = window.open('', '_blank');
  const title = document.title;
  newWindow.document.write(`
    <html>
      <head>
        <title>Transcript - ${title}</title>
        <style>
          body { font-family: Arial, sans-serif; padding: 20px; line-height: 1.6; }
          h2 { margin-bottom: 20px; }
        </style>
      </head>
      <body>
        <h2>${title}</h2>
        ${transcriptContent.innerHTML}
      </body>
    </html>
  `);
  newWindow.document.close();
  newWindow.focus();
}
   
/* ===========================
   Inline Video Logic
   ===========================
*/

  document.addEventListener("click", function(e) {
    const wrapper = e.target.closest(".inline-video-wrapper");
    if (!wrapper || wrapper.classList.contains("video-loaded")) return;

    const type = wrapper.dataset.videoType;
    const id   = wrapper.dataset.videoId;
    const vh   = wrapper.dataset.videoH || ""; // Vimeo unlisted hash support

    let iframe = document.createElement("iframe");
iframe.setAttribute("allowfullscreen", "");
iframe.setAttribute("frameborder", "0");
iframe.setAttribute("allow", "autoplay; fullscreen; picture-in-picture"); 
iframe.style.position = "absolute";
iframe.style.top = "0";
iframe.style.left = "0";
iframe.style.width = "100%";
iframe.style.height = "100%";
  
    if (type === "youtube") {
      iframe.src = "https://www.youtube.com/embed/" + id + "?autoplay=1&rel=0&playsinline=1&mute=1";
    } else if (type === "vimeo") {
      var hashParam = vh ? ("&h=" + encodeURIComponent(vh)) : "";
      iframe.src = "https://player.vimeo.com/video/" + id + "?autoplay=1&muted=1&title=0&byline=0&portrait=0&playsinline=1" + hashParam;
    }
  
    const container = wrapper.querySelector(".video-aspect");
    container.innerHTML = ""; 
    container.appendChild(iframe);

    // Hide/remove the overlay after loading the iframe
    const overlay = wrapper.querySelector(".video-overlay");
    if (overlay) overlay.style.display = "none";

    wrapper.classList.add("video-loaded");
  });

/* ===========================
   General Modal (custom-modal) for templates
   - Supports .open-post-modal and .open-video-lightbox
   - Imported from modal.js and inlined here
   =========================== */
(function () {
  "use strict";

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
    modal.innerHTML = '\n      <div class="custom-modal-box" data-modal-box>\n        <button type="button" class="custom-modal-close" aria-label="Close">&#x2715;</button>\n        <div class="custom-modal-content" data-modal-content></div>\n      </div>\n    ';
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
    const closeBtn = qs(".custom-modal-close", modal);
    if (closeBtn) closeBtn.focus();
    document.addEventListener("keydown", onKeydown);
  }

  function closeModal() {
    if (!isOpen) return;
    modal.classList.remove("active");
    document.body.classList.remove("modal-open");
    const content = qs("[data-modal-content]", modal);
    if (content) content.innerHTML = "";
    if (modal.parentNode) modal.parentNode.removeChild(modal);
    isOpen = false;
    document.removeEventListener("keydown", onKeydown);
    if (lastFocused && lastFocused.focus) lastFocused.focus();
  }

  function onKeydown(e) {
    if (e.key === "Escape") closeModal();
  }

  modal.addEventListener("click", function (e) {
    const isOutside = e.target === modal;
    const isCloseBtn = e.target.closest && e.target.closest(".custom-modal-close");
    if (isOutside || isCloseBtn) closeModal();
  });

  async function loadPostIntoModal(postId, postType) {
    const contentEl = qs("[data-modal-content]", modal);
    if (!contentEl) return;
    contentEl.innerHTML = '<div class="p-6"><div class="text-gray-500 text-sm">Loading…</div></div>';

    var apiRootLink = document.querySelector('link[rel="https://api.w.org/"]');
    var apiRoot = apiRootLink && apiRootLink.href ? apiRootLink.href.replace(/\/$/, '') : (typeof window.wpApiSettings !== 'undefined' && window.wpApiSettings.root ? String(window.wpApiSettings.root).replace(/\/$/, '') : (window.location.origin + '/wp-json'));
    var type = (postType || 'posts').toLowerCase();
    if (type === 'post') type = 'posts';
    var url = `${apiRoot}/wp/v2/${type}/${postId}?_embed=1`;

    try {
      const response = await fetch(url, { credentials: 'same-origin' });
      if (!response.ok) throw new Error('Fetch failed');
      const post = await response.json();
      var title = post && post.title && post.title.rendered ? post.title.rendered : 'Untitled';
      var bodyHtml = (post && post.content && post.content.rendered) ? post.content.rendered : '';
      if (!bodyHtml || bodyHtml.trim() === '') {
        bodyHtml = (post && post.excerpt && post.excerpt.rendered) ? post.excerpt.rendered : '<p>No content available.</p>';
      }
      var thumb = '';
      try {
        var mediaArr = post && post._embedded && post._embedded['wp:featuredmedia'] ? post._embedded['wp:featuredmedia'] : null;
        var media = mediaArr && mediaArr[0] ? mediaArr[0] : null;
        var imgUrl = media && media.source_url ? media.source_url : '';
        if (imgUrl) {
          thumb = `<img src="${imgUrl}" alt="" style="max-width:100%;height:auto;border-radius:6px;margin-bottom:16px;"/>`;
        }
      } catch (e) {}

      contentEl.innerHTML = `
        <article class="prose max-w-none p-6">
          <h2 class="text-2xl font-semibold mb-4">${title}</h2>
          ${thumb}
          <div class="entry-content">${bodyHtml}</div>
        </article>
      `;
    } catch (err) {
      contentEl.innerHTML = '<div class="p-6 text-red-600">Failed to load. Please try again.</div>';
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
    iframe.style.height = "56.25vw";
    iframe.style.maxHeight = "80vh";
    iframe.style.maxWidth = "1280px";
    iframe.style.aspectRatio = "16/9";
    iframe.style.border = "0";
    contentEl.innerHTML = "";
    contentEl.appendChild(iframe);
  }

  function handlePostTriggerClick(e) {
    const btn = e.currentTarget;
    const postId = btn.getAttribute("data-post-id");
    const postType = btn.getAttribute("data-post-type") || 'posts';
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
        // If it's a testimonial, prefer server-rendered modal with inline video
        var postType = el.getAttribute('data-post-type') || 'posts';
        var postId = el.getAttribute('data-post-id');
        if (String(postType).toLowerCase() === 'testimonial') {
          (async function(){
            const apiRootLink = document.querySelector('link[rel="https://api.w.org/"]');
            const apiRoot = apiRootLink && apiRootLink.href ? apiRootLink.href.replace(/\/$/, '') : (typeof window.wpApiSettings !== 'undefined' && window.wpApiSettings.root ? String(window.wpApiSettings.root).replace(/\/$/, '') : (window.location.origin + '/wp-json'));
            const url = `${apiRoot}/hs/v1/testimonial-modal/${postId}`;
            try {
              openModal();
              const contentEl = qs("[data-modal-content]", document);
              if (contentEl) contentEl.innerHTML = '<div class="p-6"><div class="text-gray-500 text-sm">Loading…</div></div>';
              const res = await fetch(url, { credentials: 'same-origin' });
              const json = await res.json();
              if (contentEl) contentEl.innerHTML = json && json.html ? json.html : '<div class="p-6">No content</div>';
              // Re-bind inline video click to ensure embed loads inside modal
              document.dispatchEvent(new Event('hs-rebind-inline-video'));
            } catch (err) {
              handlePostTriggerClick(e);
            }
          })();
        } else {
          handlePostTriggerClick(e);
        }
      });
    });

    qsa(".open-video-lightbox", root).forEach(function (el) {
      el.addEventListener("click", function (e) {
        e.preventDefault();
        handleVimeoTriggerClick(e);
      });
    });
  }

  bindTriggers(document);
  const observer = new MutationObserver(function (mutations) {
    for (var i = 0; i < mutations.length; i++) {
      const m = mutations[i];
      if (m.addedNodes && m.addedNodes.length) {
        m.addedNodes.forEach(function (node) {
          if (node.nodeType === 1) bindTriggers(node);
        });
      }
    }
  });
  observer.observe(document.documentElement || document.body, { childList: true, subtree: true });
})();

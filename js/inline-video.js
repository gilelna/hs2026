function hsBindInlineVideoClicks(doc){
document.addEventListener("click", function(e) {
    const wrapper = e.target.closest(".inline-video-wrapper");
    if (!wrapper || wrapper.classList.contains("video-loaded")) return;
  
    const type = wrapper.dataset.videoType;
    const id   = wrapper.dataset.videoId;
    const vh   = wrapper.dataset.videoH || '';
  
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
}

hsBindInlineVideoClicks(document);
document.addEventListener('hs-rebind-inline-video', function(){
  hsBindInlineVideoClicks(document);
});
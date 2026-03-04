# Shortcodes

All shortcodes are modularized under `includes/shortcodes/` and auto-loaded from `functions.php`.

- podcast-player (`includes/shortcodes/podcast-player.php`)
  - Tags: `[EpisodePlayerEmbed]`, `[podcast_player]`
  - Renders a Spotify or Libsyn embed, with audio fallback.

- inline-video (`includes/shortcodes/inline-video.php`)
  - Tags: `[videoinline]`, `[inlinevideo]`
  - Click-to-play YouTube/Vimeo with responsive thumbnail. JS handled in `js/main.js`.

- transcript-box (`includes/shortcodes/transcript-box.php`)
  - Tag: `[transcript_box]`
  - Renders transcript modal per post with print option.

- testimonial-grid (`includes/shortcodes/testimonial-grid.php`)
  - Tag: `[testimonial_grid]`
  - Outputs the testimonials grid using `get_template_part('testimonials-grid')`.

- freebies (`includes/shortcodes/freebies.php`)
  - Tag: `[freebie_badge]`
  - Shows a "Freebie Inside" badge when post is in `freebies` category.

- edit-post-link (`includes/shortcodes/edit-post-link.php`)
  - Tag: `[edit_post_link]`
  - Shows edit link for users with permission.



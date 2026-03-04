# Functions Glossary

Scope: active theme runtime files (excluding `_legacy`, which is optional reference and not deployed).

## `functions.php`

| Function | Purpose | Hooks / Filters |
| --- | --- | --- |
| `hello_elementor_child_enqueue_scripts()` | Enqueues parent/child/theme CSS stack, including Tailwind output and fonts. | `add_action('wp_enqueue_scripts', ..., 20)` |
| `hs2026_enqueue_modal_css()` | Enqueues modal stylesheet. | `add_action('wp_enqueue_scripts', ...)` |
| `hs2026_enqueue_main_script()` | Enqueues main frontend JS bundle. | `add_action('wp_enqueue_scripts', ...)` |
| `hs2026_theme_setup()` | Registers theme supports, editor styles, textdomain, and menus. | `add_action('after_setup_theme', ...)` |
| `hs_rest_testimonial_modal(WP_REST_Request $request)` | REST callback that renders testimonial modal HTML and injects inline video shortcode when available. | Routed from `add_action('rest_api_init', fn() => register_rest_route(...))` |
| `hs2026_enqueue_blocks_css()` | Enqueues frontend block CSS after main child styles. | `add_action('wp_enqueue_scripts', ..., 30)` |

Anonymous hooks in this file:
- `add_action('add_meta_boxes', function() { ... })` - adds related post metabox to `podcast`.
- `add_action('rest_api_init', function() { ... })` - registers `/hs/v1/testimonial-modal/{id}` route.
- `add_action('init', function() { ... })` - registers block pattern category and group block style.
- `add_filter('is_protected_meta', '__return_false')` - exposes protected meta for current implementation.

## `includes/index/load.php`

| Function | Purpose | Hooks / Filters |
| --- | --- | --- |
| `hs2026_require_module($relative_path)` | Safe guarded `require_once` helper for module files; logs missing modules in `WP_DEBUG`. | None (called directly by loader) |

Module loading behavior:
- Loads `post-type.php`.
- Loads Elementor dominator from `src/includes/elementor-dominator.php` with fallback to `includes/elementor-dominator.php`.
- Loads inline video module from `includes/shortcodes/inline-video.php`.
- Autoloads additional `includes/shortcodes/*.php`.

## `includes/shortcodes/inline-video.php`

| Function | Purpose | Hooks / Filters |
| --- | --- | --- |
| `hs_inline_video_shortcode($atts)` | Renders an inline video wrapper for YouTube/Vimeo using shortcode attributes or post meta (`wpcf-video-url`). | `add_shortcode('videoinline', ...)`, `add_shortcode('inlinevideo', ...)` |

## `src/includes/elementor-dominator.php`

| Function | Purpose | Hooks / Filters |
| --- | --- | --- |
| `hs2026_is_elementor_editor_context()` | Detects Elementor editor/preview contexts to avoid dequeuing assets during editing. | Used internally |
| `hs2026_is_clean_like_template()` | Checks the global flag used by clean templates to disable Elementor assets. | Used internally |
| `hs2026_should_disable_elementor_assets()` | Central decision function for whether Elementor assets should be disabled for current request. | Used internally |
| `hs2026_maybe_disable_elementor_assets()` | Dequeues/deregisters Elementor scripts/styles when page context is clean/non-Elementor. | `add_action('wp_enqueue_scripts', ..., 100)` |
| `hs2026_maybe_disable_parent_theme_assets()` | Removes parent/reset styles for clean contexts to prevent style leakage. | `add_action('wp_enqueue_scripts', ..., 99)` |
| `hs2026_disable_elementor_assets()` | Helper for templates to set disable flag. | Used by templates/modules directly |
| `hs2026_force_remove_reset_css_by_src()` | Final defensive pass that removes any enqueued style whose source includes `reset.css`. | `add_action('wp_print_styles', ..., 1)` |

## `post-type.php`

| Function | Purpose | Hooks / Filters |
| --- | --- | --- |
| `register_custom_post_types()` | Registers the `testimonial` CPT. | `add_action('init', ...)` |
| `register_custom_taxonomies()` | Registers custom taxonomies (`collection`, `kind`, `testimonials-group`). | `add_action('init', ...)` |
| `render_transcript_metabox($post)` | Renders transcript editor metabox. | Used via metabox callbacks |
| `render_related_post_metabox($post)` | Renders related post ID metabox. | Used via metabox callbacks |
| `render_linked_podcast_metabox($post)` | Renders linked podcast ID metabox with edit link validation. | Used via metabox callbacks |
| `render_episode_details_metabox($post)` | Renders episode fields (number, duration, date, video URL). | Used via metabox callbacks |
| `add_testimonial_meta_boxes()` | Registers testimonial fields metabox. | `add_action('add_meta_boxes', ...)` |
| `render_testimonial_fields($post)` | Renders testimonial-specific custom fields. | Used via metabox callbacks |
| `save_testimonial_meta($post_id)` | Saves testimonial custom fields. | `add_action('save_post', ...)` |
| `render_podcast_ids_metabox($post)` | Renders Libsyn/Spotify ID metabox fields. | Used via metabox callbacks |
| `sync_linked_podcast_backlink($post_id, $post, $update)` | Keeps backlink from linked podcast to post in sync on save. | `add_action('save_post', ..., 20, 3)` |

Anonymous hooks in this file:
- `add_action('add_meta_boxes', function() { ... })` - bulk metabox registration for transcript/related/linked/podcast IDs/episode details.
- `add_action('add_meta_boxes', function() { remove_meta_box(...) }, 20)` - removes legacy related podcast metabox from `post`.
- `add_action('save_post', function($post_id) { ... })` - saves transcript/related/linked/episode/podcast fields.
- `add_action('add_meta_boxes', function() { ... })` - adds related post metabox to `podcast`.
- `add_action('init', function() { ... })` - registers REST-exposed post meta fields.

## Template and Pattern Files (Scanned)
- `index.php` - no function definitions (silence template).
- `single.php` - template markup loop; no custom function definitions.
- `patterns/*.php` - block pattern definitions/markup; no reusable PHP function definitions.

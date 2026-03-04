# Theme Map

## Folder Map
- `functions.php` - theme bootstrap, hooks, enqueue logic, REST helpers.
- `theme.json` - global style tokens and editor defaults.
- `style.css` - WP theme header + child stylesheet overrides.
- `css/` - compiled/runtime CSS assets (`output.css`, `blocks.css`, etc.).
- `js/` - frontend JavaScript (`main.js` and related runtime scripts).
- `patterns/` - Gutenberg block patterns (starter layout library).
- `post-type.php` - CPT, taxonomy, metabox, and meta registration.
- `includes/` - modular theme features.
- `includes/index/load.php` - module index loader (single include entrypoint).
- `includes/shortcodes/` - shortcode modules (including inline video).
- `src/includes/` - additional feature modules (e.g., Elementor asset controls).
- `_docs/` - project documentation and planning docs.
- `_legacy/` - optional reference only, not deployed.

## Tailwind Note
- Tailwind tooling lives in `tailwind/` and is for local build workflows.
- Production runtime only depends on generated `css/output.css`.

## Elementor Dominator Concept
- Goal: keep Elementor assets loaded only on Elementor-needed pages.
- Module location: `src/includes/elementor-dominator.php`.
- This prevents Elementor CSS/JS from leaking into clean block-first templates.

## Patterns Approach
- Patterns are the first-line reusable UI system.
- New sections should start as patterns in `patterns/`.
- Prefer Gutenberg-native layout blocks; keep utility classes focused on styling.

## Inline Video Module
- Inline video is a **theme feature**, not a plugin feature.
- Module file: `includes/shortcodes/inline-video.php`.
- Registered shortcodes: `[videoinline]` and `[inlinevideo]`.
- Module is loaded centrally through `includes/index/load.php`.

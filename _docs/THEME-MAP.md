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
  - `theme-setup.php` – enqueues assets, registers theme supports/menus, and `hs2026_img()` helper.
  - `fse-setup.php` – FSE/Elementor coexistence: strips Elementor assets and restores WP block canvas on non-Elementor pages only.
  - `block-styles.php` – registers custom block style variations.
  - `block-inspector/` – block inspector editor tool.
- `includes/index/load.php` - module index loader (single include entrypoint).
- `includes/shortcodes/` - shortcode modules (including inline video).
- `src/includes/` - additional feature modules (e.g., Elementor asset controls).
- `_docs/` - project documentation and planning docs.
- `_legacy/` - optional reference only, not deployed.

## Tailwind Note
- Tailwind tooling lives in `tailwind/` and is for local build workflows.
- Production runtime only depends on generated `css/output.css`.

## Elementor / FSE Coexistence

The theme runs Elementor pages and FSE block pages side-by-side:

- **Elementor dominator** (`src/includes/elementor-dominator.php`) — strips Elementor assets when a global disable flag is set or when the page uses a "clean" template.
- **FSE setup** (`includes/fse-setup.php`) — for non-Elementor pages on a block theme: sets the disable flag, restores the WP block-template canvas if Elementor hijacked it, and removes Elementor Pro Theme Builder header/footer hooks.
- **Guard:** `hs2026_fse_should_override()` checks `_elementor_edit_mode = builder` on the current post — Elementor-built pages are never touched by the FSE layer.

## Patterns Approach
- Patterns are the first-line reusable UI system.
- New sections should start as patterns in `patterns/`.
- Prefer Gutenberg-native layout blocks; keep utility classes focused on styling.

## Inline Video Module
- Inline video is a **theme feature**, not a plugin feature.
- Module file: `includes/shortcodes/inline-video.php`.
- Registered shortcodes: `[videoinline]` and `[inlinevideo]`.
- Module is loaded centrally through `includes/index/load.php`.

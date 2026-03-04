# HS2026 Theme

HS2026 is a WordPress child theme (`hs2026`) running on top of `twentytwentyfive`.
It is built for block-first pages (Gutenberg + Patterns + `theme.json`) with Elementor enabled only where needed.

## Architecture at a Glance
- **Parent/child setup:** `twentytwentyfive` parent + `hs2026` child.
- **Design system:** `theme.json` controls global styles/tokens; patterns provide reusable layouts.
- **Elementor strategy:** scoped usage only; theme includes asset controls so clean templates stay lightweight.
- **Theme modules:** centralized through `includes/index/load.php` (single module index).
- **Inline video:** stays a theme feature (`includes/shortcodes/inline-video.php`), not a plugin.

## Docs Index
Project docs live in `_docs/`:
- `_docs/STATUS.md` - current stage and release checkpoints
- `_docs/WORKFLOW.md` - day-to-day development flow
- `_docs/STACK-PLUGINS.md` - external/custom plugins inventory template
- `_docs/THEME-MAP.md` - folder map and module loading model
- `_docs/FUNCTIONS-GLOSSARY.md` - function + hooks index
- `_docs/TODO.md` - phased roadmap checklist

## Tailwind Build (Dev Tooling Only)
Tailwind tooling is inside `tailwind/` and used for local development.
Production only needs generated `css/output.css` (enqueued by the theme).

```bash
cd "wp-content/themes/hs2026/tailwind"
npm install
npm run dev
# or
npm run build
```

## Getting Started Checklist
- [ ] Parent theme `twentytwentyfive` is installed and active-compatible.
- [ ] Child theme `hs2026` is active and loads without fatal errors.
- [ ] Tailwind build runs and writes `css/output.css`.
- [ ] Frontend loads `css/output.css` and core child styles.
- [ ] Elementor pages still work; non-Elementor/clean pages stay isolated.
- [ ] Review `_docs/` before adding new modules, patterns, or shortcodes.


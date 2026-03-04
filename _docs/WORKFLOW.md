# HS2026 Workflow

## Local Development Flow
1. **Verify theme boots**
   - Activate `hs2026` (parent: `twentytwentyfive`).
   - Confirm frontend/admin load without fatal errors.
2. **Run Tailwind build**
   - From `tailwind/`, run `npm run dev` or `npm run build`.
   - Confirm generated file: `css/output.css`.
3. **Verify CSS enqueue**
   - Frontend: confirm `css/output.css` is loaded.
   - Editor (optional): verify editor styling aligns with theme intent.
4. **Build patterns**
   - Add/update pattern files under `patterns/`.
   - Test insertion and visual consistency in block editor.

## Where to Add Things
- **Patterns:** `patterns/*.php`
- **Template parts / templates:** theme template files (block-first approach). For example, `page-fullwidth.php` wraps `the_content()` inside an `alignfull` container so any sections inside stretch edge‑to‑edge.
- **PHP feature modules:** `includes/` (loaded by `includes/index/load.php`).
  - `theme-setup.php` now houses enqueue helpers and theme support registrations.
- **Shortcodes:** `includes/shortcodes/*.php`
- **Core CPT/meta logic:** `post-type.php`
- **Theme JS:** `js/`
- **Theme CSS output:** `css/output.css` (generated), `style.css` (theme stylesheet)
- **Tailwind dev tooling:** `tailwind/` only

## Rules of Thumb
- Layout with Gutenberg primitives (`Group`, `Columns`, `Row`) first.
- Do not build page layout around Tailwind grid utilities.
- Use Tailwind for controlled utilities and component-level styling only.
- Keep runtime modules discoverable through the loader index.

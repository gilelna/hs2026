# HS2026 TODO

## Phase 0 - Cleanup + Boot Verification
- [x] Confirm theme boots with no PHP fatal errors. *(fixed 2026-03-06: added `hs2026_img()`, removed pattern manual-require loop)*
- [x] Confirm module index loader is the only include entrypoint from `functions.php`.
- [ ] Confirm `css/output.css` exists and frontend styles load.
- [ ] Confirm legacy folder is treated as optional reference only (not deployed).
- [x] Elementor/FSE coexistence: `fse-setup.php` guards against stripping Elementor on Elementor-built pages.

## Phase 1 - `theme.json` Branding
- [ ] Finalize color palette tokens.
- [ ] Finalize typography scale + font families.
- [ ] Finalize spacing scale and block defaults.
- [ ] Validate editor/front consistency.

## Phase 2 - Starter Patterns (5-10)
- [ ] Build hero pattern(s).
- [ ] Build testimonials pattern(s).
- [ ] Build CTA / offer pattern(s).
- [ ] Build media + text pattern(s).
- [ ] Build footer/promo strip pattern(s).

## Phase 3 - Optional Custom Blocks (Later)
- [ ] Countdown block.
- [ ] Animated counters block.
- [ ] Tabs/accordion block.

## Phase 4 - Admin Hub / Wiki (Later)
- [ ] Add editor-facing usage guide page.
- [ ] Add pattern library governance notes.
- [ ] Add plugin/module ownership matrix.

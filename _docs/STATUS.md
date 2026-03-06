# HS2026 Status

## Current Stage
1. **Bootstrap theme baseline**
   - Verify child theme boots on top of `twentytwentyfive`.
   - Verify no fatal errors in theme module loading.
2. **Branding foundation (`theme.json`)**
   - Lock palette, typography, spacing tokens.
3. **Pattern-first page building**
   - Expand reusable block patterns and template parts.
4. **Custom blocks later**
   - Only after pattern system is stable.

## Non-Goals (For Now)
- No large plugin framework initiative.
- No heavy third-party block-library dependency.
- No Tailwind-led layout system (layout remains Gutenberg-native).

## Release Checklist
- [x] Theme loads cleanly with no PHP fatal errors. *(2026-03-06)*
- [ ] Child CSS + generated `css/output.css` load as expected.
- [x] Elementor/FSE coexistence: Elementor pages unaffected, FSE pages strip Elementor assets. *(2026-03-06)*
- [ ] Pattern library has started and is reusable across pages.

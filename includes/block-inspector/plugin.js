/**
 * HS2026 Block Inspector — Spacing & Display Panel
 *
 * Adds a "Spacing & Display" panel to every block's Inspector sidebar.
 * Controls inject/remove Tailwind utility classes on the block className.
 *
 * Breakpoint prefixes: (none) = all screens, md: = tablet+, lg: = desktop+
 */

const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, SelectControl, ToggleControl, __experimentalGrid: Grid } = wp.components;
const { Fragment } = wp.element;
const { __ } = wp.i18n;

// ─── Config ──────────────────────────────────────────────────────────────────

const BREAKPOINTS = [
  { label: 'All screens', prefix: '' },
  { label: 'md (768px+)', prefix: 'md:' },
  { label: 'lg (1024px+)', prefix: 'lg:' },
];

const SPACING_STEPS = [
  { label: '—', value: '' },
  { label: '0',   value: '0'  },
  { label: '1',   value: '1'  },
  { label: '2',   value: '2'  },
  { label: '3',   value: '3'  },
  { label: '4',   value: '4'  },
  { label: '5',   value: '5'  },
  { label: '6',   value: '6'  },
  { label: '8',   value: '8'  },
  { label: '10',  value: '10' },
  { label: '12',  value: '12' },
  { label: '16',  value: '16' },
  { label: '20',  value: '20' },
  { label: '24',  value: '24' },
  { label: '32',  value: '32' },
  { label: '40',  value: '40' },
  { label: '48',  value: '48' },
];

const DISPLAY_OPTIONS = [
  { label: '— (inherit)',    value: '' },
  { label: 'block',          value: 'block'        },
  { label: 'inline-block',   value: 'inline-block'  },
  { label: 'flex',           value: 'flex'          },
  { label: 'grid',           value: 'grid'          },
  { label: 'hidden (none)',  value: 'hidden'        },
];

// Spacing props  →  Tailwind prefix
const SPACING_PROPS = [
  { label: 'Padding Top',    tw: 'pt' },
  { label: 'Padding Bottom', tw: 'pb' },
  { label: 'Padding Left',   tw: 'pl' },
  { label: 'Padding Right',  tw: 'pr' },
  { label: 'Margin Top',     tw: 'mt' },
  { label: 'Margin Bottom',  tw: 'mb' },
  { label: 'Margin Left',    tw: 'ml' },
  { label: 'Margin Right',   tw: 'mr' },
];

// ─── Helpers ─────────────────────────────────────────────────────────────────

/**
 * Parse current className into a set of tokens we "own" vs the rest.
 * We own any class that matches a known Tailwind pattern we generate.
 */
function buildOwnedPattern() {
  const spacingPrefixes = SPACING_PROPS.map(p => p.tw).join('|');
  const bpPrefixes = ['', 'md:', 'lg:'].map(p => p.replace(':', '\\:')).join('|');
  // e.g.  pt-4  md:pb-8  lg:hidden  block  md:flex
  return new RegExp(
    `^(?:${bpPrefixes})?(?:${spacingPrefixes})-\\d+$` +
    `|^(?:${bpPrefixes})?(?:block|inline-block|flex|grid|hidden)$`
  );
}

const OWNED_RE = buildOwnedPattern();

function stripOwnedClasses(className = '') {
  return className
    .split(/\s+/)
    .filter(cls => cls && !OWNED_RE.test(cls))
    .join(' ');
}

function addClasses(className = '', newClasses = []) {
  const base = stripOwnedClasses(className);
  const all = [base, ...newClasses.filter(Boolean)].join(' ').trim();
  return all.replace(/\s+/g, ' ');
}

/**
 * Given a full className string, extract the current value for one
 * Tailwind utility, e.g. ('pt', 'md:') → '4' if 'md:pt-4' is present.
 */
function extractValue(className = '', tw, bpPrefix) {
  const escaped = bpPrefix.replace(':', '\\:');
  const re = new RegExp(`(?:^|\\s)${escaped}${tw}-(\\d+)(?:\\s|$)`);
  const m = className.match(re);
  return m ? m[1] : '';
}

function extractDisplay(className = '', bpPrefix) {
  const escaped = bpPrefix.replace(':', '\\:');
  const displayVals = ['block', 'inline-block', 'flex', 'grid', 'hidden'];
  for (const d of displayVals) {
    const re = new RegExp(`(?:^|\\s)${escaped}${d}(?:\\s|$)`);
    if (re.test(className)) return d;
  }
  return '';
}

/**
 * Recompute className: strip ALL owned classes then re-add from state object.
 * state = { pt:'', pb:'4', ... display:{ '':'block', 'md:':'hidden', ... } }
 */
function buildClassName(originalClassName, state) {
  const base = stripOwnedClasses(originalClassName);
  const newClasses = [];

  // Spacing
  for (const prop of SPACING_PROPS) {
    for (const bp of BREAKPOINTS) {
      const val = (state.spacing[bp.prefix] || {})[prop.tw];
      if (val) newClasses.push(`${bp.prefix}${prop.tw}-${val}`);
    }
  }

  // Display
  for (const bp of BREAKPOINTS) {
    const val = state.display[bp.prefix];
    if (val) newClasses.push(`${bp.prefix}${val}`);
  }

  return [base, ...newClasses].join(' ').replace(/\s+/g, ' ').trim();
}

// ─── HOC ─────────────────────────────────────────────────────────────────────

const withSpacingDisplayPanel = createHigherOrderComponent(BlockEdit => {
  return function HS2026InspectorWrapper(props) {
    const { attributes, setAttributes, name } = props;
    const className = attributes.className || '';

    // ── derive state from current className ──────────────────────────────────
    // We read live from className each render so we stay in sync with other
    // tools (Advanced panel, etc.) that also write to className.

    function getSpacingVal(bp, tw) {
      return extractValue(className, tw, bp.prefix);
    }
    function getDisplayVal(bp) {
      return extractDisplay(className, bp.prefix);
    }

    // ── setters ──────────────────────────────────────────────────────────────

    function setSpacing(bpPrefix, tw, value) {
      // Build full state snapshot from current className, then patch one value
      const state = snapshotState();
      if (!state.spacing[bpPrefix]) state.spacing[bpPrefix] = {};
      state.spacing[bpPrefix][tw] = value;
      setAttributes({ className: buildClassName(className, state) });
    }

    function setDisplay(bpPrefix, value) {
      const state = snapshotState();
      state.display[bpPrefix] = value;
      setAttributes({ className: buildClassName(className, state) });
    }

    function snapshotState() {
      const spacing = {};
      const display = {};
      for (const bp of BREAKPOINTS) {
        spacing[bp.prefix] = {};
        for (const prop of SPACING_PROPS) {
          spacing[bp.prefix][prop.tw] = extractValue(className, prop.tw, bp.prefix);
        }
        display[bp.prefix] = extractDisplay(className, bp.prefix);
      }
      return { spacing, display };
    }

    // ── render ───────────────────────────────────────────────────────────────

    const paddingProps = SPACING_PROPS.filter(p => p.tw.startsWith('p'));
    const marginProps  = SPACING_PROPS.filter(p => p.tw.startsWith('m'));

    return (
      wp.element.createElement(Fragment, null,
        wp.element.createElement(BlockEdit, props),

        wp.element.createElement(InspectorControls, { group: 'styles' },
          wp.element.createElement(PanelBody, {
            title: __('Spacing & Display', 'hs2026'),
            initialOpen: false,
            className: 'hs2026-spacing-panel',
          },

            /* ── Padding ── */
            wp.element.createElement('p', { className: 'hs2026-panel-section-label' },
              __('Padding', 'hs2026')
            ),
            BREAKPOINTS.map(bp =>
              wp.element.createElement('div', { key: 'pad-' + bp.prefix, className: 'hs2026-bp-group' },
                wp.element.createElement('p', { className: 'hs2026-bp-label' }, bp.label),
                wp.element.createElement('div', { className: 'hs2026-grid-4' },
                  paddingProps.map(prop =>
                    wp.element.createElement(SelectControl, {
                      key: prop.tw,
                      label: prop.label.replace('Padding ', ''),
                      value: getSpacingVal(bp, prop.tw),
                      options: SPACING_STEPS,
                      onChange: val => setSpacing(bp.prefix, prop.tw, val),
                      __nextHasNoMarginBottom: true,
                    })
                  )
                )
              )
            ),

            wp.element.createElement('hr', { className: 'hs2026-divider' }),

            /* ── Margin ── */
            wp.element.createElement('p', { className: 'hs2026-panel-section-label' },
              __('Margin', 'hs2026')
            ),
            BREAKPOINTS.map(bp =>
              wp.element.createElement('div', { key: 'mar-' + bp.prefix, className: 'hs2026-bp-group' },
                wp.element.createElement('p', { className: 'hs2026-bp-label' }, bp.label),
                wp.element.createElement('div', { className: 'hs2026-grid-4' },
                  marginProps.map(prop =>
                    wp.element.createElement(SelectControl, {
                      key: prop.tw,
                      label: prop.label.replace('Margin ', ''),
                      value: getSpacingVal(bp, prop.tw),
                      options: SPACING_STEPS,
                      onChange: val => setSpacing(bp.prefix, prop.tw, val),
                      __nextHasNoMarginBottom: true,
                    })
                  )
                )
              )
            ),

            wp.element.createElement('hr', { className: 'hs2026-divider' }),

            /* ── Display ── */
            wp.element.createElement('p', { className: 'hs2026-panel-section-label' },
              __('Display', 'hs2026')
            ),
            BREAKPOINTS.map(bp =>
              wp.element.createElement(SelectControl, {
                key: 'disp-' + bp.prefix,
                label: bp.label,
                value: getDisplayVal(bp),
                options: DISPLAY_OPTIONS,
                onChange: val => setDisplay(bp.prefix, val),
                __nextHasNoMarginBottom: true,
              })
            ),

            /* ── Live class preview ── */
            wp.element.createElement('hr', { className: 'hs2026-divider' }),
            wp.element.createElement('p', {
              className: 'hs2026-class-preview',
              title: __('All classes currently on this block', 'hs2026'),
            }, className || __('(no classes)', 'hs2026'))
          )
        )
      )
    );
  };
}, 'withSpacingDisplayPanel');

addFilter(
  'editor.BlockEdit',
  'hs2026/spacing-display-panel',
  withSpacingDisplayPanel
);

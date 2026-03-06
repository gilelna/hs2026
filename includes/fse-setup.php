<?php
/**
 * FSE (Full Site Editor) setup & Elementor override
 *
 * When this theme is a block theme (templates/index.html exists):
 *  1. Strip all Elementor assets on every non-editor frontend request.
 *  2. Prevent Elementor from hijacking the template_include filter so the
 *     WordPress block-template canvas (and our FSE header/footer parts) always win.
 *
 * The Elementor editor/preview is always left untouched.
 */

/**
 * Returns true only when we are safe to override Elementor.
 * (block theme active + not inside Elementor editor/preview + page not built with Elementor)
 */
function hs2026_fse_should_override() {
	if ( is_admin() ) {
		return false;
	}
	if ( ! function_exists( 'wp_is_block_theme' ) || ! wp_is_block_theme() ) {
		return false;
	}
	if ( function_exists( 'hs2026_is_elementor_editor_context' ) && hs2026_is_elementor_editor_context() ) {
		return false;
	}
	// Don't strip Elementor on pages that were built with Elementor.
	if ( is_singular() ) {
		$post_id = get_queried_object_id();
		if ( 'builder' === get_post_meta( $post_id, '_elementor_edit_mode', true ) ) {
			return false;
		}
	}
	return true;
}

/**
 * 1. Signal the Elementor dominator to strip all Elementor assets.
 *    Runs at wp priority 5, well before wp_enqueue_scripts (99/100).
 */
add_action( 'wp', function () {
	if ( ! hs2026_fse_should_override() ) {
		return;
	}
	global $hs2026_disable_elementor_assets;
	$hs2026_disable_elementor_assets = true;
}, 5 );

/**
 * 2. Prevent Elementor from replacing the WordPress block-template canvas.
 *
 *    Elementor's PageTemplates module hooks into template_include at ~priority 20
 *    and replaces the resolved block template canvas with its own canvas file.
 *    We hook at 99999 — after Elementor — and restore the WP block canvas so
 *    our FSE templates/index.html (and header/footer template parts) render.
 */
add_filter( 'template_include', function ( $template ) {
	if ( ! hs2026_fse_should_override() ) {
		return $template;
	}

	// If Elementor has swapped in its own canvas/theme file, put the WP block
	// canvas back so the FSE template hierarchy takes over.
	if ( strpos( $template, 'elementor' ) !== false ) {
		$wp_canvas = ABSPATH . WPINC . '/template-canvas.php';
		if ( file_exists( $wp_canvas ) ) {
			return $wp_canvas;
		}
	}

	return $template;
}, 99999 );

/**
 * 3. Remove Elementor Pro Theme Builder header/footer output hooks.
 *
 *    Even after restoring the block canvas, Elementor Pro may still try to
 *    inject its Theme Builder header/footer via classic theme hooks.
 *    Removing those actions lets our FSE template parts render unobstructed.
 */
add_action( 'wp', function () {
	if ( ! hs2026_fse_should_override() ) {
		return;
	}
	if ( ! class_exists( '\\ElementorPro\\Modules\\ThemeBuilder\\Module' ) ) {
		return;
	}

	$theme_builder = \ElementorPro\Modules\ThemeBuilder\Module::instance();
	if ( ! $theme_builder ) {
		return;
	}

	// Disconnect Theme Builder from the classic header/footer action hooks.
	foreach ( [ 'before_do_header', 'after_do_header', 'before_do_footer', 'after_do_footer' ] as $hook ) {
		remove_action( 'elementor/theme/' . $hook, [ $theme_builder, $hook ] );
	}
}, 20 );

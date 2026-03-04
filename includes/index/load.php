<?php
/**
 * HS2026 module index loader.
 *
 * Single source of truth for loading modular theme files.
 */

if ( ! function_exists( 'hs2026_require_module' ) ) {
	/**
	 * Require a module relative to the stylesheet directory.
	 *
	 * Logs only in WP_DEBUG to avoid noisy production logs.
	 *
	 * @param string $relative_path Path relative to the active child theme root.
	 * @return bool True when module was loaded, false when missing.
	 */
	function hs2026_require_module( $relative_path ) {
		$full_path = trailingslashit( get_stylesheet_directory() ) . ltrim( $relative_path, '/' );
		if ( file_exists( $full_path ) ) {
			require_once $full_path;
			return true;
		}

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			error_log( '[hs2026] Missing module: ' . $relative_path );
		}

		return false;
	}
}

// Core feature modules.
hs2026_require_module( 'post-type.php' );

// Theme setup & asset enqueue helpers
hs2026_require_module( 'includes/theme-setup.php' );

// Editor styles/patterns module (block styles, pattern categories, etc.)
hs2026_require_module( 'includes/block-styles.php' );

// Elementor dominator: support current + legacy module locations.
if ( ! hs2026_require_module( 'src/includes/elementor-dominator.php' ) ) {
	hs2026_require_module( 'includes/elementor-dominator.php' );
}

// Inline Video is a theme-level feature module.
hs2026_require_module( 'includes/shortcodes/inline-video.php' );

// Load additional shortcode modules if present.
foreach ( glob( get_stylesheet_directory() . '/includes/shortcodes/*.php' ) ?: array() as $shortcode_file ) {
	require_once $shortcode_file;
}

<?php
/**
 * HS2026 Block Inspector — Spacing & Display Panel
 *
 * Registers the editor plugin that adds a "Spacing & Display" panel
 * to every block's Inspector Controls sidebar.
 *
 * Loaded via includes/index/load.php
 *
 * @package HS2026Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue the block inspector script and editor styles.
 */
function hs2026_enqueue_block_inspector() {

    $dir = get_stylesheet_directory() . '/includes/block-inspector/';
    $uri = get_stylesheet_directory_uri() . '/includes/block-inspector/';

    // ── JavaScript plugin ────────────────────────────────────────────────────
    $js_path = $dir . 'plugin.js';
    if ( ! file_exists( $js_path ) ) {
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
            error_log( '[hs2026] block-inspector plugin.js not found.' );
        }
        return;
    }

    wp_enqueue_script(
        'hs2026-block-inspector',
        $uri . 'plugin.js',
        [
            'wp-hooks',
            'wp-compose',
            'wp-blocks',
            'wp-block-editor',
            'wp-components',
            'wp-element',
            'wp-i18n',
        ],
        filemtime( $js_path ),
        false // must load in <head> so filter runs before blocks render
    );

    // ── Editor CSS ───────────────────────────────────────────────────────────
    $css_path = $dir . 'editor.css';
    if ( file_exists( $css_path ) ) {
        wp_enqueue_style(
            'hs2026-block-inspector-editor',
            $uri . 'editor.css',
            [ 'wp-edit-blocks' ],
            filemtime( $css_path )
        );
    }
}
add_action( 'enqueue_block_editor_assets', 'hs2026_enqueue_block_inspector' );

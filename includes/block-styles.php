<?php
/**
 * Block pattern categories & styles
 *
 * Consolidate all editor-facing style registrations in one module. Loaded by
 * `includes/index/load.php` during theme bootstrap.
 */

add_action( 'init', function () {
    // ✅ custom pattern category used by `patterns/` PHP snippets
    register_block_pattern_category(
        'hs2026',
        [ 'label' => __( 'HS 2026', 'hello-elementor-child-hs2026' ) ]
    );

    if ( function_exists( 'register_block_style' ) ) {
        // style for group blocks (used in several patterns)
        register_block_style(
            'core/group',
            [
                'name'  => 'hs-card',
                'label' => __( 'HS Card', 'hello-elementor-child-hs2026' ),
            ]
        );

        // additional heading style added 2026‑03‑04
        register_block_style(
            'core/heading',
            [
                'name'  => 'big-title',
                'label' => __( 'Big Title', 'hello-elementor-child-hs2026' ),
            ]
        );
    }
} );

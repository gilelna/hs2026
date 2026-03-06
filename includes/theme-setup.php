<?php
/**
 * Theme setup and asset enqueueing
 *
 * This module keeps all of the front‑end style/script helpers and the
 * basic `after_setup_theme` registration in a dedicated file so the
 * root `functions.php` stays thin and focused on bootstrap duties.
 *
 * Loaded by `includes/index/load.php`.
 */

// --- theme image helper -----------------------------------------------------

/**
 * Returns the URL for a file inside the theme's /images/ directory.
 *
 * Used in block patterns as a placeholder image source so the pattern preview
 * renders without hard-coded absolute URLs.
 *
 * @param string $filename Filename relative to the theme /images/ folder.
 * @return string Absolute URL.
 */
function hs2026_img( $filename ) {
	return get_stylesheet_directory_uri() . '/images/' . ltrim( $filename, '/' );
}

// --- asset enqueue helpers --------------------------------------------------

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
    // On clean templates we avoid loading Hello theme CSS to keep Tailwind layout clean
    $is_clean = function_exists('hs2026_is_clean_like_template') && hs2026_is_clean_like_template();

    // Parent theme style (Twenty Twenty-Five) — only on non-clean templates
    if ( ! $is_clean ) {
        $parent_style_handle = 'twentytwentyfive-style';
        if ( wp_style_is( $parent_style_handle, 'registered' ) ) {
            wp_enqueue_style( $parent_style_handle );
        } else {
            $parent_style_path = get_template_directory() . '/style.css';
            $parent_style_ver  = file_exists( $parent_style_path ) ? filemtime( $parent_style_path ) : null;
            wp_enqueue_style( $parent_style_handle, get_template_directory_uri() . '/style.css', [], $parent_style_ver );
        }
    }

    // Tailwind compiled CSS
    $tailwind_css_path = get_stylesheet_directory() . '/css/output.css';
    $tailwind_ver      = file_exists( $tailwind_css_path ) ? filemtime( $tailwind_css_path ) : null;
    $tailwind_deps = $is_clean ? [] : [ 'twentytwentyfive-style' ];
    wp_enqueue_style( 'tailwind-output', get_stylesheet_directory_uri() . '/css/output.css', $tailwind_deps, $tailwind_ver );

    // Optional: fonts
    wp_enqueue_style( 'custom-fonts', get_stylesheet_directory_uri() . '/fonts/fonts.css', [], null );

    // Child theme styles (loaded last to override Tailwind if needed)
    $child_style_path = get_stylesheet_directory() . '/style.css';
    $child_style_ver  = file_exists( $child_style_path ) ? filemtime( $child_style_path ) : '1.0.0';
    wp_enqueue_style( 'child-extra-style', get_stylesheet_directory_uri() . '/style.css', [ 'tailwind-output' ], $child_style_ver );
}

/**
 * Enqueue modal CSS only (modal.js merged into main.js)
 */
function hs2026_enqueue_modal_css() {
    $css_path = get_stylesheet_directory() . '/css/modal.css';
    $css_ver = file_exists($css_path) ? filemtime($css_path) : null;
    wp_enqueue_style('hs2026-modal', get_stylesheet_directory_uri() . '/css/modal.css', array(), $css_ver);
}

/**
 * Enqueue main.js script with versioning (includes modal and inline video JS)
 */
function hs2026_enqueue_main_script() {
    $js_path = get_stylesheet_directory() . '/js/main.js';
    $js_ver  = file_exists($js_path) ? filemtime($js_path) : null;
    wp_enqueue_script('hs2026-main', get_stylesheet_directory_uri() . '/js/main.js', array(), $js_ver, true);
}

// attach handlers
add_action('wp_enqueue_scripts', 'hs2026_enqueue_modal_css');
add_action('wp_enqueue_scripts', 'hs2026_enqueue_main_script');
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20);

// --- theme setup -----------------------------------------------------------

/**
 * Theme setup: textdomain, supports, and menus.
 */
function hs2026_theme_setup() {
    load_theme_textdomain( 'hello-elementor-child-hs2026', get_stylesheet_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    // Load editor styles so block editor reflects frontend branding
    add_editor_style( [ 'fonts/fonts.css', 'css/blocks.css', 'style.css' ] );
    add_theme_support( 'responsive-embeds' );
    // allow wide/full alignments in block editor
    add_theme_support( 'align-wide' );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'hello-elementor-child-hs2026' ),
        'footer'  => __( 'Footer Menu', 'hello-elementor-child-hs2026' ),
    ) );
}
add_action( 'after_setup_theme', 'hs2026_theme_setup' );

// post formats are still part of visual support
add_theme_support( 'post-formats',
    array(
        'aside',
        'gallery',
        'link',
        'image',
        'quote',
        'status',
        'video',
        'audio',
        'chat'
    )
);
add_post_type_support( 'post', 'post-formats' );

<?php
/**
 * Theme functions and definitions
 *
 * @package HS2026Child
 */

/**
 * Load child theme css and optional scripts
 *  1447 26022026 

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

    wp_enqueue_style(
        'hs2026-modal',
        get_stylesheet_directory_uri() . '/css/modal.css',
        array(),
        $css_ver
    );
}

/**
 * Enqueue main.js script with versioning (includes modal and inline video JS)
 */
function hs2026_enqueue_main_script() {
    $js_path = get_stylesheet_directory() . '/js/main.js';
    $js_ver  = file_exists($js_path) ? filemtime($js_path) : null;

    wp_enqueue_script(
        'hs2026-main',
        get_stylesheet_directory_uri() . '/js/main.js',
        array(),
        $js_ver,
        true
    );
}

add_action('wp_enqueue_scripts', 'hs2026_enqueue_modal_css');
add_action('wp_enqueue_scripts', 'hs2026_enqueue_main_script');

// Enqueue styles on frontend
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

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


// Central module loader (CPTs, shortcodes, Elementor asset controls, etc.)
require_once get_stylesheet_directory() . '/includes/index/load.php';


add_action('add_meta_boxes', function() {
    add_meta_box(
        'related_post_meta',
        __( 'Related Post', 'hello-elementor-child-hs2026' ),
        function($post) {
            $related_post_id = get_post_meta($post->ID, 'related_post', true);
            if ($related_post_id) {
                $edit_link = get_edit_post_link($related_post_id);
                echo '<p><strong>' . esc_html__( 'Linked Post:', 'hello-elementor-child-hs2026' ) . '</strong> <a href="' . esc_url($edit_link) . '" target="_blank">' . esc_html__( 'Edit Post #', 'hello-elementor-child-hs2026' ) . intval($related_post_id) . '</a></p>';
            } else {
                echo '<p>' . esc_html__( 'No linked post found.', 'hello-elementor-child-hs2026' ) . '</p>';
            }
        },
        'podcast',
        'normal',
        'default'
    );
});



// ============================
// REST: Testimonial modal HTML (includes [inlinevideo] when w-video present)
// ============================
add_action('rest_api_init', function () {
    register_rest_route('hs/v1', '/testimonial-modal/(?P<id>\\d+)', array(
        'methods'  => 'GET',
        'callback' => 'hs_rest_testimonial_modal',
        'permission_callback' => '__return_true',
    ));
});

function hs_rest_testimonial_modal( WP_REST_Request $request ) {
    $post_id = isset($request['id']) ? intval($request['id']) : 0;
    if (!$post_id || get_post_status($post_id) !== 'publish') {
        return new WP_REST_Response(array('html' => '<div class="p-6 text-red-600">Not found.</div>'), 404);
    }
    if (get_post_type($post_id) !== 'testimonial') {
        return new WP_REST_Response(array('html' => '<div class="p-6 text-red-600">Invalid post type.</div>'), 400);
    }

    $title   = get_the_title($post_id);
    $content = get_post_field('post_content', $post_id);
    $content = apply_filters('the_content', $content);
    $excerpt = get_the_excerpt($post_id);

    $video_url     = trim((string) get_post_meta($post_id, 'wpcf-video-url', true));
    $has_video     = $video_url !== '';

    ob_start(); ?>
    <article class="prose max-w-none p-0 md:p-6">
        <?php if ($has_video): ?>
            <div class="mb-6">
                <?php
                global $post;
                $prev_post = $post;
                $post = get_post($post_id);
                setup_postdata($post);
                echo do_shortcode('[videoinline]');
                wp_reset_postdata();
                $post = $prev_post;
                ?>
            </div>
        <?php endif; ?>
        <h2 class="text-2xl md:text-3xl font-title font-semibold mb-4"><?php echo esc_html($title); ?></h2>
        <div class="entry-content">
            <?php echo $content ? $content : wpautop( esc_html( $excerpt ) ); ?>
        </div>
    </article>
    <?php
    $html = ob_get_clean();
    return new WP_REST_Response(array('html' => $html), 200);
}

// (shortcodes are autoloaded above)

add_filter('is_protected_meta', '__return_false');

// ============================
// Enqueue Gutenberg blocks CSS on frontend
// ============================
function hs2026_enqueue_blocks_css() {
    $path = get_stylesheet_directory() . '/css/blocks.css';
    $ver  = file_exists($path) ? filemtime($path) : null;
    wp_enqueue_style('hs2026-blocks', get_stylesheet_directory_uri() . '/css/blocks.css', [ 'child-extra-style' ], $ver);
}
add_action('wp_enqueue_scripts', 'hs2026_enqueue_blocks_css', 30);

// ============================
// Block Patterns category
// ============================
add_action('init', function () {
    register_block_pattern_category(
        'hs2026',
        [ 'label' => __( 'HS 2026', 'hello-elementor-child-hs2026' ) ]
    );

    // Register block styles for core blocks
    if ( function_exists('register_block_style') ) {
        register_block_style(
            'core/group',
            [
                'name'  => 'hs-card',
                'label' => __( 'HS Card', 'hello-elementor-child-hs2026' ),
            ]
        );
    }
});


?>

<?php
/**
 * Theme functions and definitions
 *
 * @package HS2026Child
 */

// theme bootstrap only; feature modules live under `includes/`

// load helpers & setup from includes/theme-setup.php
require_once get_stylesheet_directory() . '/includes/theme-setup.php';

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



?>

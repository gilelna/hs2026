<?php
/**
 * Register Custom Post Types, Taxonomies, and Meta Boxes
 * Based on Toolset definitions, optimized for Elementor compatibility
 * Author: Gil Elnatan
 *  17072026 1750
 *
 * 
 *   
 * ========================
 *  Register Post Types
 * ======================== */

function register_custom_post_types() {

    // Testimonials CPT
    register_post_type('testimonial', [
        'labels' => [
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
            'edit_item' => 'Edit Testimonial',
            'add_new_item' => 'Add New Testimonial',
            'new_item' => 'New Testimonial',
            'view_item' => 'View Testimonial',
            'search_items' => 'Search Testimonials',
            'not_found' => 'No testimonials found',
            'not_found_in_trash' => 'No testimonials found in Trash',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'testimonial'],
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest' => true,
        'taxonomies' => ['post_tag'], // 👈 כאן החיבור לטאגים

    ]);
}
add_action('init', 'register_custom_post_types');

/* ========================
 *  Register Taxonomies
 * ======================== */

function register_custom_taxonomies() {

    register_taxonomy('collection', ['episode', 'post'], [
        'labels' => [
            'name' => 'Collections',
            'singular_name' => 'Collection',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'collection'],
    ]);

    register_taxonomy('kind', ['page'], [
        'labels' => [
            'name' => 'Kinds',
            'singular_name' => 'Kind',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'kind'],
    ]);

    register_taxonomy('testimonials-group', ['testimonial'], [
        'labels' => [
            'name' => 'Testimonial Groups',
            'singular_name' => 'Testimonial Group',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'testimonials-group'],
    ]);
}
add_action('init', 'register_custom_taxonomies');

/* ========================
 *  Register Custom Meta Boxes + REST Fields 
 * ======================== */

add_action('add_meta_boxes', function() {
    // Transcript WYSIWYG on Posts, Episodes, and Podcasts
    foreach ( ['post','episode','podcast'] as $screen ) {
        add_meta_box(
            'transcript_metabox',
            'Transcript',
            'render_transcript_metabox',
            $screen,
            'normal',
            'default'
        );
    }
    // Related Post ID on Episodes
    add_meta_box(
        'related_post_metabox',
        'Related Post ID',
        'render_related_post_metabox',
        'episode',
        'side',
        'default'
    );
    // Add Linked Meta Boxes
    add_meta_box(
        'linked_podcast_metabox',
        'Linked Podcast Episode',
        'render_linked_podcast_metabox',
        'post',
        'side',
        'default'
    );
    // Podcast Platform IDs metabox for 'podcast'
    add_meta_box(
        'podcast_ids_metabox',
        'Podcast Platform IDs',
        'render_podcast_ids_metabox',
        'podcast',
        'normal',
        'default'
    );
    // Add Episode details metabox for 'episode' and 'post' post types
    $screen = get_current_screen();
    if ($screen && in_array($screen->post_type, ['episode', 'post'])) {
        add_meta_box(
            'episode_details_metabox',
            'Episode details',
            'render_episode_details_metabox',
            $screen->post_type,
            'normal',
            'default'
        );
    }
});

// Remove Related Podcast ID metabox from 'post'
add_action('add_meta_boxes', function() {
    remove_meta_box('related_podcast_metabox', 'post', 'side');
}, 20);

// Render callback for transcript
function render_transcript_metabox( $post ) {
    wp_nonce_field('transcript_metabox', 'transcript_metabox_nonce');
    $content = get_post_meta( $post->ID, '_transcript_content', true );
    wp_editor( $content, 'transcript_editor_'.$post->ID, [
        'textarea_name' => '_transcript_content',
        'textarea_rows' => 10,
        'media_buttons'=> false,
        'teeny'        => true,
    ]);
}

// Render callback for related post ID
function render_related_post_metabox( $post ) {
    wp_nonce_field('related_post_metabox', 'related_post_nonce');
    $value = get_post_meta( $post->ID, '_related_post_id', true );
    echo '<label for="related_post_id">Post ID:</label><br />';
    echo '<input type="number" name="_related_post_id" id="related_post_id" value="'. esc_attr($value) .'" style="width:100%;" />';
}

// Render Linked Podcast
function render_linked_podcast_metabox( $post ) {
    wp_nonce_field('linked_podcast_metabox', 'linked_podcast_nonce');
    $value = get_post_meta( $post->ID, '_linked_podcast_id', true );
    echo '<label for="linked_podcast_id">Podcast Episode ID:</label><br />';
    echo '<input type="number" name="_linked_podcast_id" id="linked_podcast_id" value="'. esc_attr($value) .'" style="width:100%;" />';
    if ($value) {
        $linked_post = get_post($value);
        if ($linked_post && $linked_post->post_status != 'trash') {
            $url = get_edit_post_link($value);
            echo '<p><a href="'.esc_url($url).'">'.esc_html($linked_post->post_title).'</a></p>';
        } else {
            echo '<p style="color:red;">⚠️ No post found with ID '.intval($value).'</p>';
        }
    }
}


function render_episode_details_metabox( $post ) {
    wp_nonce_field('episode_details_metabox', 'episode_details_metabox_nonce');

    $episode_number = get_post_meta($post->ID, 'wpcf-episode-number', true);
    $episode_duration = get_post_meta($post->ID, 'wpcf-episode-duration', true);
    $publish_date = get_post_meta($post->ID, 'wpcf-publish-date', true);
    $video_url = get_post_meta($post->ID, 'wpcf-video-url', true);

    $formatted_date = $publish_date ? date('Y-m-d', $publish_date) : '';

    echo '<p><label>episode number</label><br />';
    echo '<input type="text" name="wpcf-episode-number" value="'.esc_attr($episode_number).'" style="width:100%;" /></p>';

    echo '<p><label>episode duration</label><br />';
    echo '<input type="text" name="wpcf-episode-duration" value="'.esc_attr($episode_duration).'" style="width:100%;" /></p>';

    echo '<p><label>Publish date</label><br />';
    echo '<input type="date" name="wpcf-publish-date" value="'.esc_attr($formatted_date).'" style="width:100%;" /></p>';

    echo '<p><label>Video url</label><br />';
    echo '<input type="url" name="wpcf-video-url" value="'.esc_attr($video_url).'" style="width:100%; color:blue;" /></p>';
}

// Save meta callback
add_action('save_post', function($post_id) {
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    // Transcript
    if ( isset($_POST['transcript_metabox_nonce']) &&
         wp_verify_nonce($_POST['transcript_metabox_nonce'],'transcript_metabox') ) {
        if ( isset($_POST['_transcript_content']) ) {
            update_post_meta($post_id, '_transcript_content', wp_kses_post($_POST['_transcript_content']));
        }
    }
    // Related Post on episode
    if ( isset($_POST['related_post_nonce']) &&
         wp_verify_nonce($_POST['related_post_nonce'],'related_post_metabox') ) {
        if ( isset($_POST['_related_post_id']) ) {
            $val = intval($_POST['_related_post_id']);
            if ( $val ) update_post_meta($post_id,'_related_post_id',$val);
            else        delete_post_meta($post_id,'_related_post_id');
        }
    }
    // Save Linked Meta
    if ( isset($_POST['linked_podcast_nonce']) &&
         wp_verify_nonce($_POST['linked_podcast_nonce'],'linked_podcast_metabox') ) {
        if ( isset($_POST['_linked_podcast_id']) ) {
            $val = intval($_POST['_linked_podcast_id']);
            if ( $val ) update_post_meta($post_id,'_linked_podcast_id',$val);
            else        delete_post_meta($post_id,'_linked_podcast_id');
        }
    }

    if ( isset($_POST['episode_details_metabox_nonce']) &&
         wp_verify_nonce($_POST['episode_details_metabox_nonce'], 'episode_details_metabox') ) {

        if ( isset($_POST['wpcf-episode-number']) ) {
            update_post_meta($post_id, 'wpcf-episode-number', sanitize_text_field($_POST['wpcf-episode-number']));
        }

        if ( isset($_POST['wpcf-episode-duration']) ) {
            update_post_meta($post_id, 'wpcf-episode-duration', sanitize_text_field($_POST['wpcf-episode-duration']));
        }

        if ( isset($_POST['wpcf-publish-date']) ) {
            $timestamp = strtotime($_POST['wpcf-publish-date']);
            update_post_meta($post_id, 'wpcf-publish-date', $timestamp);
        }

        if (isset($_POST['wpcf-video-url'])) {
            update_post_meta($post_id, 'wpcf-video-url', esc_url_raw($_POST['wpcf-video-url']));
        }

    }
    // Save Podcast Platform IDs for podcast
    if (array_key_exists('wpcf-libsyn-id', $_POST)) {
        update_post_meta($post_id, 'wpcf-libsyn-id', sanitize_text_field($_POST['wpcf-libsyn-id']));
    }
    if (array_key_exists('wpcf-spotify-episode-id', $_POST)) {
        update_post_meta($post_id, 'wpcf-spotify-episode-id', sanitize_text_field($_POST['wpcf-spotify-episode-id']));
    }
});

// Add testimonial meta boxes
function add_testimonial_meta_boxes() {
    add_meta_box('testimonial_fields', 'Testimonials', 'render_testimonial_fields', 'testimonial', 'normal', 'default');
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

function render_testimonial_fields($post) {
    $fname = get_post_meta($post->ID, 'wpcf-testi_fname', true);
    $lname = get_post_meta($post->ID, 'wpcf-testi_lname', true);
    $video_url = get_post_meta($post->ID, 'wpcf-video-url', true);
    $videolightbox = get_post_meta($post->ID, 'videolightbox', true);
    $alt_img = get_post_meta($post->ID, 'wpcf-alter-img', true);
    ?>
    <label>First Name</label><br>
    <input type="text" name="wpcf-testi_fname" value="<?php echo esc_attr($fname); ?>" /><br>
    <label>Last Name</label><br>
    <input type="text" name="wpcf-testi_lname" value="<?php echo esc_attr($lname); ?>" /><br>
    <label>Video lightbox</label><br>
    <input type="text" name="videolightbox" value="<?php echo esc_attr($videolightbox); ?>" /><br>
    <label>Video URL </label><br>
    <input type="text" name="wpcf-video-url" value="<?php echo esc_attr($video_url); ?>" style="width:100%; color:blue;" /><br>
    <label>Alt Image URL</label><br>
    <input type="text" name="wpcf-alter-img" value="<?php echo esc_attr($alt_img); ?>" /><br>
    <?php
}

function save_testimonial_meta($post_id) {
    foreach (['wpcf-testi_fname', 'wpcf-testi_lname', 'videolightbox', 'wpcf-alter-img'] as $field) {
        if (array_key_exists($field, $_POST)) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
    if (array_key_exists('wpcf-video-url', $_POST)) {
        update_post_meta($post_id, 'wpcf-video-url', esc_url_raw($_POST['wpcf-video-url']));
    }
}
add_action('save_post', 'save_testimonial_meta');
// Render Podcast Platform IDs metabox
function render_podcast_ids_metabox($post) {
    $libsyn = get_post_meta($post->ID, 'wpcf-libsyn-id', true);
    $spotify = get_post_meta($post->ID, 'wpcf-spotify-episode-id', true);
    ?>
    <p><label for="wpcf-libsyn-id">Libsyn ID</label><br />
    <input type="text" name="wpcf-libsyn-id" value="<?php echo esc_attr($libsyn); ?>" style="width:100%;" /></p>
    
    <p><label for="wpcf-spotify-episode-id">Spotify Episode ID</label><br />
    <input type="text" name="wpcf-spotify-episode-id" value="<?php echo esc_attr($spotify); ?>" style="width:100%;" /></p>
    <?php
}

// New function to sync linked podcast backlink
add_action('save_post', 'sync_linked_podcast_backlink', 20, 3);
function sync_linked_podcast_backlink($post_id, $post, $update) {
    // Only apply to 'post' type (or change to your actual post type slug)
    if ($post->post_type !== 'post') {
        return;
    }

    // Avoid infinite loop
    remove_action('save_post', 'sync_linked_podcast_backlink', 20);

    // Get linked podcast ID
    $linked_podcast_id = get_post_meta($post_id, '_linked_podcast_id', true);

    if (!empty($linked_podcast_id) && get_post_type($linked_podcast_id) === 'podcast') {
        // Update the podcast's meta field with this post ID
        update_post_meta($linked_podcast_id, 'linked_post_id', $post_id);
    }

    // Re-add the hook
    add_action('save_post', 'sync_linked_podcast_backlink', 20, 3);
}

add_action('add_meta_boxes', function() {
    add_meta_box(
        'related_post_meta',
        'Related Post',
        function($post) {
            $related_post_id = get_post_meta($post->ID, 'related_post', true);
            if ($related_post_id) {
                $edit_link = get_edit_post_link($related_post_id);
                echo '<p><strong>Linked Post:</strong> <a href="' . esc_url($edit_link) . '" target="_blank">Edit Post #' . intval($related_post_id) . '</a></p>';
            } else {
                echo '<p>No linked post found.</p>';
            }
        },
        'podcast',
        'normal',
        'default'
    );
});

/* ========================
 *  Register Custom Meta Fields for REST support
 * ======================== */
add_action('init', function() {
    /*
     * Register Custom Meta Fields for REST support (fixed)
     * ----------------------------------------------------
     * Notes:
     * - Use register_post_meta( $post_type, $meta_key, $args ) to target specific CPTs.
     * - Types/sanitizers match save logic above (IDs => integer/absint, URLs => esc_url_raw, HTML => wp_kses_post).
     */

    // _transcript_content (HTML) for post, episode, podcast
    foreach (['post','episode','podcast'] as $pt) {
        register_post_meta($pt, '_transcript_content', [
            'type'              => 'string',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => 'wp_kses_post',
        ]);
    }

    // _related_post_id (integer) for episode
    register_post_meta('episode', '_related_post_id', [
        'type'              => 'integer',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'absint',
    ]);

    // _linked_podcast_id (integer) for post
    register_post_meta('post', '_linked_podcast_id', [
        'type'              => 'integer',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'absint',
    ]);

    // wpcf-episode-number (string) for episode, post
    foreach (['episode','post'] as $pt) {
        register_post_meta($pt, 'wpcf-episode-number', [
            'type'              => 'string',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => 'sanitize_text_field',
        ]);
    }

    // wpcf-episode-duration (string) for episode, post
    foreach (['episode','post'] as $pt) {
        register_post_meta($pt, 'wpcf-episode-duration', [
            'type'              => 'string',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => 'sanitize_text_field',
        ]);
    }

    // wpcf-publish-date (timestamp integer) for episode, post
    foreach (['episode','post'] as $pt) {
        register_post_meta($pt, 'wpcf-publish-date', [
            'type'              => 'integer',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => 'absint',
        ]);
    }

    // wpcf-video-url (URL string) for episode, post, testimonial
    foreach (['episode','post','testimonial'] as $pt) {
        register_post_meta($pt, 'wpcf-video-url', [
            'type'              => 'string',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => 'esc_url_raw',
        ]);
    }

    // wpcf-libsyn-id (string) for podcast
    register_post_meta('podcast', 'wpcf-libsyn-id', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    // wpcf-spotify-episode-id (string) for podcast
    register_post_meta('podcast', 'wpcf-spotify-episode-id', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    // wpcf-testi_fname (string) for testimonial
    register_post_meta('testimonial', 'wpcf-testi_fname', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    // wpcf-testi_lname (string) for testimonial
    register_post_meta('testimonial', 'wpcf-testi_lname', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    // videolightbox (string) for testimonial
    register_post_meta('testimonial', 'videolightbox', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    // wpcf-alter-img (URL string) for testimonial
    register_post_meta('testimonial', 'wpcf-alter-img', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'esc_url_raw',
    ]);

    // related_post (integer) for podcast
    register_post_meta('podcast', 'related_post', [
        'type'              => 'integer',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'absint',
    ]);

    // linked_post_id (integer) for podcast
    register_post_meta('podcast', 'linked_post_id', [
        'type'              => 'integer',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'absint',
    ]);
});
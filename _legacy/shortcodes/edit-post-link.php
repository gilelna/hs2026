<?php
/**
 * Shortcode: Edit Post Link
 *
 * Usage: [edit_post_link post_id="" text="Edit this post" class="edit-post-link" icon="yes"]
 */

if (!function_exists('hs_edit_post_link_shortcode')) {
function hs_edit_post_link_shortcode( $atts = [] ) {
	if ( ! is_user_logged_in() ) return '';

	global $post;
	$atts = shortcode_atts([
		'post_id' => $post ? $post->ID : 0,
		'text'    => 'Edit this post',
		'class'   => 'edit-post-link',
		'icon'    => 'yes', // 'yes' or 'no'
	], $atts, 'edit_post_link');

	$post_id = intval( $atts['post_id'] );
	if ( ! $post_id ) return '';

	// ✅ Check if user has permission to edit this specific post
	if ( ! current_user_can('edit_post', $post_id) ) return '';

	$url = get_edit_post_link( $post_id, '' );
	if ( ! $url ) return '';

	$icon_html = ( strtolower($atts['icon']) === 'yes' )
		? '<span class="dashicons dashicons-edit"></span> '
		: '';

	return sprintf(
		'<a href="%s" class="%s">%s%s</a>',
		esc_url( $url ),
		esc_attr( $atts['class'] ),
		$icon_html,
		esc_html( $atts['text'] )
	);
}
}

add_action('init', function() {
	add_shortcode('edit_post_link', 'hs_edit_post_link_shortcode');
});



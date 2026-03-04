<?php
/**
 * Shortcode: Freebie Badge
 *
 * Usage: [freebie_badge]
 */

if (!function_exists('hs_freebie_badge_shortcode')) {
function hs_freebie_badge_shortcode() {
	global $post;

	if ( has_category('freebies', $post) ) {
		return '<div class="freebie-badge">Freebie Inside</div>';
	}

	return '';
}
}

add_shortcode('freebie_badge', 'hs_freebie_badge_shortcode');



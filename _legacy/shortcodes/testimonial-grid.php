<?php
/**
 * Shortcode: Testimonial Grid
 *
 * Usage: [testimonial_grid per_page="-1" order="ASC" orderby="menu_order" group=""]
 */

if (!function_exists('hs_testimonial_grid_shortcode')) {
function hs_testimonial_grid_shortcode($atts = []) {
	$atts = shortcode_atts([
		'per_page' => -1,
		'order'    => 'ASC',
		'orderby'  => 'menu_order',
		'group'    => '', // testimonials-group slug
	], $atts, 'testimonial_grid');

	$args = [
		'post_type'      => 'testimonial',
		'posts_per_page' => intval($atts['per_page']),
		'order'          => $atts['order'],
		'orderby'        => $atts['orderby'],
	];

	if (!empty($atts['group'])) {
		$args['tax_query'] = [
			[
				'taxonomy' => 'testimonials-group',
				'field'    => 'slug',
				'terms'    => sanitize_title($atts['group']),
			],
		];
	}

	ob_start();
	// Pass args via get_template_part third parameter (available as $args in template)
	get_template_part('testimonials-grid', null, $args);
	return ob_get_clean();
}
}

add_shortcode('testimonial_grid', 'hs_testimonial_grid_shortcode');



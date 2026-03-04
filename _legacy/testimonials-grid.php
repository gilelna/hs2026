<?php
/**
 * Testimonials Grid Loop (Grid 1)
 *
 * Usage examples:
 *   get_template_part('testimonials-grid');
 *   get_template_part('testimonials-grid', null, [ 'posts_per_page' => 12 ]);
 *   echo do_shortcode('[testimonial_grid per_page="12" order="ASC"]');
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('hs2026v6_resolve_testimonial_alt_image')) {
    function hs2026v6_resolve_testimonial_alt_image(int $post_id): array {
        $alt_meta = get_post_meta($post_id, 'wpcf-alter-img', true);
        $alt_url  = '';

        if (!empty($alt_meta)) {
            if (is_numeric($alt_meta)) {
                $alt_url = wp_get_attachment_image_url((int) $alt_meta, 'large') ?: '';
            } elseif (is_array($alt_meta)) {
                if (!empty($alt_meta['url'])) {
                    $alt_url = $alt_meta['url'];
                } elseif (!empty($alt_meta[0]['url'])) {
                    $alt_url = $alt_meta[0]['url'];
                } elseif (!empty($alt_meta[0])) {
                    $alt_url = $alt_meta[0];
                }
            } else {
                $alt_url = (string) $alt_meta;
            }
        }

        return [
            'url'        => $alt_url,
            'has_alt_pic'=> !empty($alt_url),
        ];
    }
}

if (!function_exists('hs2026v6_build_testimonial_context')) {
    function hs2026v6_build_testimonial_context(WP_Post $post): array {
        $post_id        = (int) $post->ID;
        $excerpt        = get_the_excerpt($post);
        $featured_image = get_the_post_thumbnail_url($post_id, 'large') ?: '';

        $fname     = trim((string) get_post_meta($post_id, 'wpcf-testi_fname', true));
        $lname     = trim((string) get_post_meta($post_id, 'wpcf-testi_lname', true));
        $full_name = trim($fname . ' ' . $lname);
        if ($full_name === '') {
            $full_name = get_the_title($post_id);
        }

        $video_url = trim((string) get_post_meta($post_id, 'wpcf-video-url', true));
        $alt = hs2026v6_resolve_testimonial_alt_image($post_id);

        return [
            'excerpt_text'  => $excerpt,
            'full_name'     => $full_name,
            'featured_image'=> $featured_image,
            'alt_pic_url'   => $alt['url'],
            'has_alt_pic'   => $alt['has_alt_pic'],
            'video_url'     => $video_url,
            'categories'    => get_the_category($post_id) ?: [],
            'tags'          => get_the_tags($post_id) ?: [],
        ];
    }
}

$default_query_args = [
    'post_type'      => 'testimonial',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
];

$incoming_args = [];
if (isset($args) && is_array($args)) {
    $incoming_args = $args;
} else {
    $query_var_args = get_query_var('testimonials_query_args');
    if (is_array($query_var_args)) {
        $incoming_args = $query_var_args;
    }
}

$query_args = wp_parse_args($incoming_args, $default_query_args);
$loop       = new WP_Query($query_args);
?>
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8 items-start">
	<?php if ($loop->have_posts()) : $index = 0; ?>
		<?php while ($loop->have_posts()) : $loop->the_post(); ?>
			<?php
				$index++;
				$post     = get_post();
				$context  = hs2026v6_build_testimonial_context($post);

				$card_args = $context;
				if (!empty($context['video_url'])) {
					$card_args['video_shortcode'] = '[videoinline video="' . esc_url_raw($context['video_url']) . '"]';
				}

				$tags = wp_get_post_tags($post->ID, ['fields' => 'slugs']);
			?>
			<div class="col-span-1">
				<?php
					if (in_array('full-width', $tags)) {
						get_template_part('template-parts/testimonial-card-full-width', null, $card_args);
					} elseif (in_array('highlight-quote', $tags)) {
						get_template_part('template-parts/testimonial-card-highlight-quote', null, $card_args);
					} elseif (in_array('video-story', $tags)) {
						<?php
						$bg_for_story = !empty($card_args['alt_pic_url']) && !empty($card_args['has_alt_pic']) ? $card_args['alt_pic_url'] : $card_args['featured_image'];
						$story_args = [
							'bg_url'  => $bg_for_story,
							'desc'    => $card_args['excerpt_text'],
							'name'    => $card_args['full_name'],
							'post_id' => get_the_ID(),
						];
						?>
						<?php get_template_part('template-parts/cards/card-video-story', null, $story_args); ?>
					} elseif (in_array('w-video', $tags) || in_array('video', $tags)) {
						get_template_part('template-parts/testimonial-card-with-video', null, $card_args);
					} else {
						get_template_part('template-parts/testimonial-card-mini', null, $card_args);
					}
				?>
			</div>
		<?php endwhile; wp_reset_postdata(); ?>
	<?php else : ?>
		<p class="col-span-3 text-center text-gray-500"><?php esc_html_e('No testimonials found.', 'hs2026v6'); ?></p>
	<?php endif; ?>
</div>

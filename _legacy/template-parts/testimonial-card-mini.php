<?php
$args = isset($args) && is_array($args) ? $args : [];

$excerpt_text   = $args['excerpt_text'] ?? ($excerpt_text ?? '');
$full_name      = $args['full_name'] ?? ($full_name ?? get_the_title());
$featured_image = $args['featured_image'] ?? ($featured_image ?? get_the_post_thumbnail_url(null, 'large'));
$alt_pic_url    = $args['alt_pic_url'] ?? ($alt_pic_url ?? '');
$has_alt_pic    = (bool) ($args['has_alt_pic'] ?? ($has_alt_pic ?? false));
$has_video      = (bool) ($args['has_video'] ?? ($has_video ?? false));

$image_url = $has_alt_pic && !empty($alt_pic_url) ? $alt_pic_url : $featured_image;
if (empty($image_url)) {
    $image_url = get_stylesheet_directory_uri() . '/css/placeholder.webp';
}

$button_label = !empty($has_video) ? 'Watch More' : 'Read More';
?>

<article class="bg-white rounded-3xl shadow-card p-6 flex flex-col gap-4 transition-transform hover:-translate-y-1">
	<div class="flex items-center gap-4">
		<img class="w-20 h-20 rounded-full object-cover" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($full_name); ?>">
		<p class="text-gold tracking-wide font-semibold"><?php echo esc_html($full_name); ?></p>
	</div>
	<p class="font-title text-xl md:text-2xl text-black leading-snug"><?php echo esc_html($excerpt_text); ?></p>
    <div class="mt-2">
		<a href="#" class="btn btn-outline rounded-full border-gold text-black open-post-modal inline-flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
			<?php if (!empty($has_video)) : ?>
				<svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
			<?php endif; ?>
			<?php echo esc_html($button_label); ?>
		</a>
	</div>
</article>


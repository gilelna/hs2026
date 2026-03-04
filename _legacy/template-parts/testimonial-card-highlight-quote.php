<?php
$args = isset($args) && is_array($args) ? $args : [];

$excerpt_text  = $args['excerpt_text'] ?? ($excerpt_text ?? '');
$full_name     = $args['full_name'] ?? ($full_name ?? get_the_title());
$has_video     = (bool) ($args['has_video'] ?? ($has_video ?? false));
$is_highlight  = (bool) ($args['is_highlight'] ?? ($is_highlight ?? false));
$is_mega       = (bool) ($args['is_mega'] ?? ($is_mega ?? false));

$button_label  = !empty($has_video) ? 'Watch More' : 'Read More';
$is_dark       = $is_mega || $is_highlight;
$card_classes  = $is_dark ? 'bg-neutral-800 text-white' : 'bg-white';
$quote_classes = $is_dark ? 'text-white' : 'text-black';
$button_classes = $is_dark ? 'btn bg-gold text-black border-0' : 'btn btn-outline border-gold text-black';
?>

<article>
	<div class="card rounded-3xl <?php echo esc_attr($card_classes); ?> shadow-card p-8 md:p-12">
		<div class="max-w-3xl">
			<div class="text-5xl text-gold mb-4">”</div>
			<p class="font-title text-2xl md:text-4xl <?php echo esc_attr($quote_classes); ?> leading-snug mb-6"><?php echo esc_html($excerpt_text); ?></p>
			<div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-4">
				<span class="text-gold tracking-wide font-semibold"><?php echo esc_html($full_name); ?></span>
				<a href="#" class="<?php echo esc_attr($button_classes); ?> rounded-full open-post-modal inline-flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
					<?php if (!empty($has_video)) : ?>
						<svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
					<?php endif; ?>
					<?php echo esc_html($button_label); ?>
				</a>
			</div>
		</div>
	</div>
</article>


<?php
$args = isset($args) && is_array($args) ? $args : [];

$excerpt_text = $args['excerpt_text'] ?? ($excerpt_text ?? '');
$full_name    = $args['full_name'] ?? ($full_name ?? get_the_title());
$has_video    = (bool) ($args['has_video'] ?? ($has_video ?? true));
$button_label = !empty($has_video) ? 'Watch More' : 'Read More';

$video_shortcode = $args['video_shortcode'] ?? null;
$video_output    = $video_shortcode ? do_shortcode($video_shortcode) : do_shortcode('[inlinevideo]');
?>

<article>
    <div class="card rounded-3xl bg-white shadow-card p-6 md:p-8">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-center">
            <div class="w-full">
				<?php echo $video_output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<div>
                <div class="text-4xl text-gold mb-3">”</div>
                <p class="font-title text-2xl md:text-3xl text-black leading-snug mb-6"><?php echo esc_html($excerpt_text); ?></p>
                <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-4">
					<span class="text-gold tracking-wide font-semibold"><?php echo esc_html($full_name); ?></span>
					<a href="#" class="btn btn-outline rounded-full border-gold text-black open-post-modal inline-flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
						<?php if (!empty($has_video)) : ?>
							<svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
						<?php endif; ?>
						<?php echo esc_html($button_label); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</article>


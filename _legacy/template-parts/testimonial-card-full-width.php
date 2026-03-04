<?php
$args = isset($args) && is_array($args) ? $args : [];

$excerpt_text = $args['excerpt_text'] ?? ($excerpt_text ?? '');
$full_name    = $args['full_name'] ?? ($full_name ?? get_the_title());
$has_video    = (bool) ($args['has_video'] ?? ($has_video ?? false));
$is_highlight = (bool) ($args['is_highlight'] ?? ($is_highlight ?? false));
$is_mega      = (bool) ($args['is_mega'] ?? ($is_mega ?? false));

$button_label = !empty($has_video) ? 'Watch More' : 'Read More';
?>

<?php if (!empty($has_video)) : ?>
  <article class="testimonial-card video-testimonial col-span-full">
	<div class="card rounded-3xl bg-white shadow-card p-6 md:p-10">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 items-center">
			<div class="w-full">
				<?php echo do_shortcode('[inlinevideo]'); ?>
			</div>
			<div>
				<div class="text-4xl text-gold mb-3">”</div>
				<p class="font-title text-2xl md:text-3xl lg:text-4xl text-black leading-snug mb-6"><?php echo esc_html($excerpt_text); ?></p>
				<div class="flex flex-wrap items-center gap-4">
					<span class="text-gold tracking-wide font-semibold"><?php echo esc_html($full_name); ?></span>
					<a href="#" class="btn btn-outline rounded-full border-gold text-black open-post-modal inline-flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
						<svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
						<?php echo esc_html($button_label); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</article>
<?php elseif (!empty($is_highlight) || !empty($is_mega)) : ?>
  <article class="testimonial-card quote-testimonial col-span-full">
	<div class="card <?php echo !empty($is_mega) ? 'bg-neutral-800 text-white' : 'bg-white'; ?> rounded-3xl p-10 md:p-16 shadow-card">
		<div class="max-w-5xl mx-auto text-center">
			<div class="text-5xl md:text-6xl text-gold mb-6">”</div>
			<h3 class="font-title text-3xl md:text-5xl lg:text-6xl leading-tight mb-6"><?php echo esc_html($excerpt_text); ?></h3>
			<a href="#" class="<?php echo !empty($is_mega) ? 'btn bg-gold text-black border-0' : 'btn btn-outline border-gold text-black'; ?> rounded-full px-6 md:px-8 open-post-modal inline-flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
				<?php if (!empty($has_video)) : ?>
					<svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
				<?php endif; ?>
				<?php echo esc_html($button_label); ?>
			</a>
			<p class="mt-4 <?php echo !empty($is_mega) ? 'text-gold' : 'text-gold'; ?> tracking-wide font-semibold text-sm md:text-base"><?php echo esc_html($full_name); ?></p>
		</div>
	</div>
</article>
<?php else : ?>
  <article class="testimonial-card quote-testimonial col-span-full">
	<div class="card rounded-3xl bg-white shadow-card p-8 md:p-12">
		<div class="max-w-5xl mx-auto">
			<div class="text-5xl text-gold mb-4">”</div>
			<p class="font-title text-2xl md:text-4xl lg:text-5xl text-black leading-snug mb-6"><?php echo esc_html($excerpt_text); ?></p>
			<div class="flex flex-wrap items-center gap-4">
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
</article>
<?php endif; ?>


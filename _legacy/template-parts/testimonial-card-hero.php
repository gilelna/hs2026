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
$permalink    = get_permalink();
?>

<article class="card-one col-span-1 transition-transform hover:-translate-y-1 relative overflow-hidden rounded-3xl shadow-card">
    <div class="card-one--bg-pic absolute inset-0" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
    <div class="absolute inset-0 z-10 w-full h-full" style="background: linear-gradient(180deg, rgba(0,0,0,0) 30%, rgba(0,0,0,0.8) 100%);"></div>
    <div class="card-one content relative z-20 p-8 flex flex-col justify-end min-h-[320px] text-white">
        <p class="card-one desc text-lg leading-relaxed mb-6"><?php echo esc_html($excerpt_text); ?></p>
        <div class="flex items-center justify-between gap-4">
            <span class="card-name uppercase tracking-wide font-semibold"><?php echo esc_html($full_name); ?></span>
            <a href="<?php echo esc_url($permalink); ?>" class="card-button open-post-modal inline-flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
                <?php if (!empty($has_video)) : ?>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M14.752 11.168l-4.796-2.7A1 1 0 008 9.2v5.6a1 1 0 001.5.866l4.796-2.7a1 1 0 000-1.732z" />
                    </svg>
                <?php endif; ?>
                <?php echo esc_html($button_label); ?>
            </a>
        </div>
    </div>
</article>

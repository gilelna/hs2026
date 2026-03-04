<?php
// For card-three, prefer alt pic if available, else bg (featured image)
$img_url = ($has_alt_pic && !empty($alt_pic_url)) ? $alt_pic_url : $bg;
?>
<!-- card-three full-width style -->
<article class="card-three col-span-full">
    <div class="flex items-center mb-4">
        <img class="w-12 h-12 rounded-full object-cover mr-3 flex-shrink-0" src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>">
        <div>
            <p class="font-semibold text-black"><?php the_title(); ?></p>
        </div>
    </div>
    <p class="text-gray-700 font-body mb-4"><?php echo esc_html($expect_excerpt); ?></p>
    <div class="mt-auto text-right">
        <a href="#" class="card-button open-post-modal flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
            <?php if ($has_video_story): ?>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M14.752 11.168l-4.796-2.7A1 1 0 008 9.2v5.6a1 1 0 001.5.866l4.796-2.7a1 1 0 000-1.732z"/>
              </svg>
              Watch More
            <?php else: ?>
              Read More
            <?php endif; ?>
        </a>
    </div>
</article>

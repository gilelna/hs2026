<?php
// For card-four, always use the featured image (large size)
$img_url = $bg;
?>
<!-- card-four full-width style -->
<article class="card-four col-span-full">
    <div class="flex items-center mb-4">
        <img class="w-20 h-20 rounded-xl object-cover mr-4 flex-shrink-0" src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>">
        <div>
            <p class="font-semibold text-black"><?php the_title(); ?></p>
        </div>
    </div>
    <p class="text-gray-700 font-body mb-4"><?php echo esc_html($expect_excerpt); ?></p>
    <div class="mt-auto text-right">
        <a href="#" class="card-button open-post-modal" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
            Watch More
        </a>
    </div>
</article>
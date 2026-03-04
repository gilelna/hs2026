<?php
// For card-two, always use the standard thumbnail (thumbnail size)
$img_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
?>
<article class="card-two col-span-1 bg-white rounded-xl shadow-card p-6 transition-transform hover:-translate-y-1 cursor-pointer group flex flex-col">
        <img class="card-avatar" src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>">
            <p class="card-name"><?php the_title(); ?></p>
    
    <p class="desc"><?php echo esc_html($expect_excerpt); ?></p>
    <div class="text-right mt-auto">
        <a href="#" class="text-sm text-gold font-semibold inline-flex items-center open-post-modal" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
            Read More
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
</article>

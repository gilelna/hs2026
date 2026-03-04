<?php
// For card-one, keep original logic with alt pic fallback
$img_url = ($has_alt_pic && !empty($alt_pic_url)) ? $alt_pic_url : $bg;
?>
<article class="card-one col-span-1 transition-transform hover:-translate-y-1">
    <div class="card-one--bg-pic"
      style="background-image: url('<?php echo esc_url($img_url); ?>');">
    </div>
    <div class="absolute inset-0 z-10 w-full h-full"
      style="background: linear-gradient(180deg, rgba(0,0,0,0) 30%, rgba(0,0,0,0.8) 100%);">
    </div>
    <div class="card-one content">
      <p class="card-one desc"><?php echo esc_html($expect_excerpt); ?></p>
      <div class="flex items-center justify-between">
        <span class="card-name"><?php the_title(); ?></span>
        <a href="#" 
          class="card-button open-post-modal flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M14.752 11.168l-4.796-2.7A1 1 0 008 9.2v5.6a1 1 0 001.5.866l4.796-2.7a1 1 0 000-1.732z" />
          </svg>
          Watch More
        </a>
      </div>
    </div>
</article>


<article class="card-one transition-transform hover:-translate-y-1">
    <!-- רקע התמונה -->
    <div class="card-one--bg-pic"
        style="background-image: url('<?php echo esc_url(get_post_meta(get_the_ID(), 'wpcf-alter-img', true)); ?>');">
    </div>

    <!-- גרדיאנט -->
    <div class="absolute inset-0 z-10 w-full h-full"
        style="background: linear-gradient(180deg, rgba(0,0,0,0) 30%, rgba(0,0,0,0.8) 100%);">
    </div>

    <!-- תוכן -->
    <div class="card-one-content">
        <p class="card-one--desc">
            <?php echo esc_html(get_post_meta(get_the_ID(), 'expect', true)); ?>
        </p>
        <div class="flex items-center justify-between">
            <span class="card-name"><?php the_title(); ?></span>
            <a href="<?php the_permalink(); ?>" class="card-button">
                <span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14.752 11.168l-4.796-2.7A1 1 0 008 9.2v5.6a1 1 0 001.5.866l4.796-2.7a1 1 0 000-1.732z" />
                    </svg>
                </span>
                Watch More
            </a>
        </div>
    </div>
</article>
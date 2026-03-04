<?php get_header(); ?>
<main class="container mx-auto py-8">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="prose lg:prose-xl">
      <?php if (has_post_thumbnail()) : ?>
        <div class="mb-6">
          <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded']); ?>
        </div>
      <?php endif; ?>
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
      <div class="mt-8 text-sm text-gray-500">
        <p>Published on <?php echo get_the_date(); ?></p>
        <p>Filed under: <?php the_category(', '); ?></p>
      </div>
      <div class="mt-12 border-t pt-4 text-xs text-gray-400">
        <h2 class="text-sm font-bold mb-2 text-gray-500">Post Meta (Debug)</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
          <?php
            $custom_fields = get_post_custom();
            foreach ($custom_fields as $key => $values) :
              // Skip WordPress internal fields
              if (strpos($key, '_') === 0) continue;
              foreach ($values as $value) :
          ?>
            <div>
              <strong><?php echo esc_html($key); ?>:</strong>
              <span><?php echo esc_html($value); ?></span>
            </div>
          <?php endforeach; endforeach; ?>
        </div>
      </div>
    </article>
  <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>

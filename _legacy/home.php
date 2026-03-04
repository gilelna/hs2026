<?php
// Home page template
get_header(); ?>
<main class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-4">Latest Posts</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="border rounded p-4 shadow">
        <?php if (has_post_thumbnail()) : ?>
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium', ['class' => 'w-full h-auto rounded mb-4']); ?>
          </a>
        <?php endif; ?>
        <h3 class="text-lg font-semibold mb-2">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <p class="text-sm text-gray-600"><?php the_excerpt(); ?></p>
      </article>
    <?php endwhile; else : ?>
      <p>No posts found.</p>
    <?php endif; ?>
  </div>
</main>
<?php get_footer(); ?>

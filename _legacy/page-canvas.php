<?php
/* Template Name: Canvas No Elementor */

// Signal to disable Elementor assets for this template
if ( function_exists( 'hs2026_disable_elementor_assets' ) ) {
	hs2026_disable_elementor_assets();
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body class="bg-white text-gray-800 font-body">
	<main id="primary" class="site-main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="prose max-w-none">
				<h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
		<?php endwhile; endif; ?>
	</main>
	<?php wp_footer(); ?>
</body>
</html>

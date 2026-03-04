<?php
/**
 * Clean header template part
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
	<a class="screen-reader-text skip-link" href="#content"><?php echo esc_html__( 'Skip to content', 'hello-elementor-child-hs2026' ); ?></a>
</header>
<div id="content" class="site-content">


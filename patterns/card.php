<?php
/**
 * Title: HS Card
 * Slug: hs2026/card
 * Categories: hs2026
 * Block Types: core/group
 * Description: Single card with image, label and title
 */
?>
<!-- wp/group {"className":"is-style-hs-card"} -->
<div class="wp-block-group is-style-hs-card"><div class="wp-block-group__inner-container"><!-- wp/image {"sizeSlug":"large","className":"hs-img-raised"} -->
<figure class="wp-block-image size-large hs-img-raised"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/css/placeholder.webp' ); ?>" alt=""/></figure>
<!-- /wp/image -->

<!-- wp/paragraph {"className":"hs-card-label hs-mb-2"} -->
<p class="hs-card-label hs-mb-2">Category</p>
<!-- /wp/paragraph -->

<!-- wp/heading {"level":3,"className":"hs-title"} -->
<h3 class="wp-block-heading hs-title">Card title goes here</h3>
<!-- /wp/heading --></div></div>
<!-- /wp/group -->



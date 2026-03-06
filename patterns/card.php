<?php
/**
 * Title: HS Card
 * Slug: hs2026/card
 * Categories: hs2026
 * Block Types: core/group
 * Description: Single card with image, label and title
 */
?>
<!-- wp:group {"className":"is-style-hs-card"} -->
<div class="wp-block-group is-style-hs-card"><div class="wp-block-group__inner-container"><!-- wp:image {"sizeSlug":"large","className":"img-raised"} -->
<figure class="wp-block-image size-large img-raised"><img src="<?php echo esc_url( hs2026_img( 'placeholder.webp' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"label-text"} -->
<p class="label-text">Category</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"fontFamily":"title","fontSize":"h3"} -->
<h3 class="wp-block-heading has-title-font-family has-h3-font-size">Card title goes here</h3>
<!-- /wp:heading --></div></div>
<!-- /wp:group -->

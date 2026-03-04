<?php
/**
 * Template Name: Full Width
 * Template Post Type: page
 *
 * A simple page template that wraps the content in an "alignfull" group
 * so Gutenberg sections naturally stretch to the browser width.  The theme
 * supports "align-wide" in the editor and basic CSS below ensures the
 * block actually reaches the viewport edges.
 */

get_header();
?>

<main id="main" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        // wrap the post content in a full-width container
        echo '<div class="wp-block-group alignfull clearfix">';
        the_content();
        echo '</div>';

        // optionally display comments or other template parts here
    endwhile;
    ?>
</main>

<?php
get_footer();

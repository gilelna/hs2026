<footer class="site-footer bg-gray-100 p-6 text-center mt-10">
  <div class="container mx-auto text-sm text-gray-600">
    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
  </div>
  <?php if (has_nav_menu('footer')) : ?>
    <nav class="footer-nav mt-4">all good here
      <?php
        wp_nav_menu([
          'theme_location' => 'footer',
          'menu_class'     => 'flex flex-wrap justify-center space-x-4 text-xs text-gray-500',
          'container'      => false,
        ]);
      ?>
    </nav>
  <?php endif; ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="site-header" class="sticky-header">
  <header id="site-header-inner" class="site-header bg-white border-b p-4 sticky-header transition-all duration-300">
    <div class="container mx-auto flex justify-between items-center">
      <div class="site-branding">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="text-xl font-bold block">
          <?php bloginfo('name'); ?>
        </a>
      </div>
      
      <nav class="hidden md:flex space-x-6">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class'     => 'flex space-x-6',
            'container'      => false,
          ]);
        ?>
      </nav>
      <?php if (has_nav_menu('primary')) : ?>
        <nav class="mobile-nav md:hidden hidden bg-white border-t mt-2" id="mobile-menu">
          <?php
            wp_nav_menu([
              'theme_location' => 'primary',
              'menu_class'     => 'flex flex-col space-y-2 p-4',
              'container'      => false,
            ]);
          ?>
        </nav>
      <?php endif; ?>

      <div class="md:hidden">
        <button id="mobile-menu-toggle" class="text-gray-700 focus:outline-none">
          <!-- hamburger-->
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- megamenu here-->
    <div id="mega-menu" class="hidden md:block bg-gray-100 shadow-inner">
      <!--sub-menu here-->
    </div>
  </header>
</div>
<script>
  const mobileToggle = document.getElementById('mobile-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }
</script>
</body>
</html>

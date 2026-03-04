<?php
//-------------------------------------------------
// Elementor asset control for gradual migration
// - Disable Elementor assets on clean templates
//   (page-canvas.php, page-clean.php, page-noelementor.php)
// - Or when _enable_elementor checkbox is not checked
// - Never interfere in admin/editor/preview
//   Runs at wp_enqueue_scripts priority 100
//-------------------------------------------------
    
if (!function_exists('hs2026_is_elementor_editor_context')) {
    function hs2026_is_elementor_editor_context() {
        if (!defined('ELEMENTOR_VERSION') || !class_exists('\\Elementor\\Plugin')) {
            return false;
        }
        if (!empty($_GET['elementor-preview']) || !empty($_GET['elementor_library'])) {
            return true;
        }
        return isset(\Elementor\Plugin::$instance->editor)
            && method_exists(\Elementor\Plugin::$instance->editor, 'is_edit_mode')
            && \Elementor\Plugin::$instance->editor->is_edit_mode();
    }
}

if (!function_exists('hs2026_is_clean_like_template')) {
    function hs2026_is_clean_like_template() {
        // Check if current template has signaled to disable Elementor
        global $hs2026_disable_elementor_assets;
        return $hs2026_disable_elementor_assets === true;
    }
}

if (!function_exists('hs2026_should_disable_elementor_assets')) {
    function hs2026_should_disable_elementor_assets() {
        if (is_admin()) {
            return false;
        }
        // Keep assets while editing/previewing with Elementor
        if (hs2026_is_elementor_editor_context()) {
            return false;
        }

        // Check if current template has signaled to disable Elementor
        if (hs2026_is_clean_like_template()) {
            return true;
        }

        return false;
    }
}

if (!function_exists('hs2026_maybe_disable_elementor_assets')) {
    function hs2026_maybe_disable_elementor_assets() {
        // Allow quick override
        if (!apply_filters('hs2026_disable_elementor_assets_enable', true)) {
            return;
        }
        if (!defined('ELEMENTOR_VERSION')) {
            return;
        }
        if (!hs2026_should_disable_elementor_assets()) {
            return;
        }

        global $wp_scripts, $wp_styles;

        // Dequeue/deregister Elementor scripts
        if ($wp_scripts instanceof \WP_Scripts) {
            foreach ((array) $wp_scripts->queue as $handle) {
                if (strpos($handle, 'elementor') === 0 || strpos($handle, 'e-') === 0) {
                    wp_dequeue_script($handle);
                    wp_deregister_script($handle);
                }
            }
        }

        // Dequeue/deregister Elementor styles
        if ($wp_styles instanceof \WP_Styles) {
            foreach ((array) $wp_styles->queue as $handle) {
                if (strpos($handle, 'elementor') === 0 || strpos($handle, 'e-') === 0) {
                    wp_dequeue_style($handle);
                    wp_deregister_style($handle);
                }
                // Also disable parent theme CSS that interferes with Tailwind
                if (in_array($handle, array('hello-elementor', 'twentytwentyfive-style', 'reset'))) {
                    wp_dequeue_style($handle);
                    wp_deregister_style($handle);
                }
            }
        }

        // Explicit common handles (belt-and-suspenders)
        $known_handles = array(
            'elementor-frontend',
            'elementor-frontend-modules',
            'elementor-pro',
            'elementor-pro-frontend',
            'elementor-icons',
            'e-animations',
            'reset', // Prevent reset.css from interfering with Tailwind
        );
        foreach ($known_handles as $h) {
            wp_dequeue_script($h);
            wp_deregister_script($h);
            wp_dequeue_style($h);
            wp_deregister_style($h);
        }

        // Prevent Elementor frontend templates from printing
        if (class_exists('\\Elementor\\Plugin') && isset(\Elementor\Plugin::$instance->frontend)) {
            $frontend = \Elementor\Plugin::$instance->frontend;
            remove_action('wp_footer', array($frontend, 'print_templates'));
            remove_action('wp_footer', array($frontend, 'wp_footer'));
        }

        // Optional: Elementor Pro popup templates (guarded)
        if (class_exists('\\ElementorPro\\Plugin')) {
            $pro = \ElementorPro\Plugin::instance();
            if (method_exists($pro, 'modules_manager')) {
                $modules_manager = $pro->modules_manager;
                if (method_exists($modules_manager, 'get_modules')) {
                    $popup_module = $modules_manager->get_modules('popup');
                    if ($popup_module && isset($popup_module->frontend)) {
                        remove_action('wp_footer', array($popup_module->frontend, 'print_templates'));
                    }
                }
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'hs2026_maybe_disable_elementor_assets', 100);

// Prevent parent theme CSS from loading on clean templates
if (!function_exists('hs2026_maybe_disable_parent_theme_assets')) {
	function hs2026_maybe_disable_parent_theme_assets() {
		if (hs2026_should_disable_elementor_assets()) {
			// Prevent parent theme CSS from loading on clean templates
			wp_dequeue_style('hello-elementor');
			wp_deregister_style('hello-elementor');
			wp_dequeue_style('twentytwentyfive-style');
			wp_deregister_style('twentytwentyfive-style');
			// Also prevent any reset.css that might be loaded by the parent theme
			wp_dequeue_style('reset');
			wp_deregister_style('reset');

			// Defensive: remove any parent-theme related handles
			global $wp_styles;
			if ($wp_styles instanceof \WP_Styles) {
				foreach ((array) $wp_styles->queue as $handle) {
					if (strpos($handle, 'hello-elementor') !== false || strpos($handle, 'twentytwentyfive') !== false) {
						wp_dequeue_style($handle);
						wp_deregister_style($handle);
					}
				}
			}
		}
	}
}
add_action('wp_enqueue_scripts', 'hs2026_maybe_disable_parent_theme_assets', 99); // Run before our main function

/**
 * Helper function for templates to signal they want Elementor assets disabled
 * Call this function at the top of any template that should not load Elementor
 */
if (!function_exists('hs2026_disable_elementor_assets')) {
    function hs2026_disable_elementor_assets() {
        global $hs2026_disable_elementor_assets;
        $hs2026_disable_elementor_assets = true;
    }
}

// As a last resort, remove any enqueued style whose src contains "reset.css"
if (!function_exists('hs2026_force_remove_reset_css_by_src')) {
	function hs2026_force_remove_reset_css_by_src() {
		if (!hs2026_should_disable_elementor_assets()) {
			return;
		}
		global $wp_styles;
		if ($wp_styles instanceof \WP_Styles) {
			foreach ((array) $wp_styles->registered as $handle => $obj) {
				$src = isset($obj->src) ? $obj->src : '';
				if ($src && strpos($src, 'reset.css') !== false) {
					wp_dequeue_style($handle);
					wp_deregister_style($handle);
				}
			}
		}
	}
}
add_action('wp_print_styles', 'hs2026_force_remove_reset_css_by_src', 1);
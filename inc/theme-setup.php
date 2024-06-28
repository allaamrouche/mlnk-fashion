<?php
function malanka_enqueue_scripts() {
    wp_enqueue_style('malanka-style', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_script('malanka-script', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);
    
    $menu_style = get_theme_mod('menu_style_choice', 'navigation');

    wp_localize_script('malanka-script', 'MalankaSettings', array(
        'menuStyle' => $menu_style,
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('favorite_nonce')
    ));

}
add_action('wp_enqueue_scripts', 'malanka_enqueue_scripts');

function malanka_config() {
        register_nav_menus(array(
            'header-menu' => __('Malanka Header Menu', 'malanka')
        ));
    
        add_theme_support('post-thumbnails');
        add_theme_support('woocommerce');
        
    }
add_action('after_setup_theme', 'malanka_config', 0);
    
add_action('wp_default_scripts', function ($scripts) {
        if (!is_admin() && isset($scripts->registered['jquery'])) {
            $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
        }
    });
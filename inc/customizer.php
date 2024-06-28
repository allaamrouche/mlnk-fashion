<?php
function malanka_customize_register($wp_customize) {
    $wp_customize->add_section('malanka_theme_options', array(
        'title' => __('Theme Options', 'malanka'),
        'priority' => 160,
    ));

    $wp_customize->add_setting('menu_style_choice', array(
        'default' => 'navigation',  // Set default value
        'transport' => 'refresh',   // How the changes are transported
    ));

    $wp_customize->add_control('menu_style_choice', array(
        'type' => 'radio',
        'section' => 'malanka_theme_options',
        'label' => __('Menu Style', 'malanka'),
        'choices' => array(
            'navigation' => __('Default Navigation', 'malanka'),
            'navigation-overlay' => __('Overlay Navigation', 'malanka'),
        ),
    ));
}
add_action('customize_register', 'malanka_customize_register');

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>

<?php 
  if (is_page_template('template-about.php') || is_page_template('template-intro.php')) {
    get_template_part('preloader');
  }
  $menu_style = get_theme_mod('menu_style_choice', 'navigation'); // Default to 'navigation'

  get_template_part($menu_style);
  //  get_template_part('navigation');
  
?> 

 
 
  
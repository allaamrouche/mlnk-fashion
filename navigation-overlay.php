<div>
<div class="header__container">
    <div class="header__logo">
        <a href="<?php echo home_url(); ?>">Malanka</a>
    </div>
    <div class="header__navigation">
        <a href="<?php echo wp_login_url(); ?>" class="header__link"><span>Login</span></a>
        <a href="#" class="header__link"><span>Search</span></a>
        <a href="#" class="header__link"><span>Favorites</span></a>
        <a href="<?php echo wc_get_cart_url(); ?>" class="header__link"><span>Cart(0)</span></a>
    </div>
    <button id="navigation__overlay--toggle" class="navigation__overlay--toggle"><span>Menu</span></button>
    
    <?php wp_nav_menu(array(
        'theme_location' => 'overlay-menu', 
        'container' => 'nav', 
        'container_class' => 'navigation__overlay', 
        'echo' => true,
        'fallback_cb' => '__return_false',
        'items_wrap' => '%3$s', 
        'depth' => 0,
        'walker' => new Malanka_Overlay_Nav_Walker(), 
    )); ?>
</div>
</div>

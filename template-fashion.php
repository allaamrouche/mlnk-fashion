<?php
/*
Template Name: Fashion Page
*/

get_header();

?>

<div id="content" class="content" data-template="fashion">
    <div class="fashion" data-background="#edeee9" data-color="#111">
     <div class="fashion__wrapper">


    <section class="fashion__slider" data-animation="reveal" data-cursor-text="view collection">
    <div class="fashion__slider__media element__reveal__inner">
        <div class="fashion__slider__media__image element__reveal__img" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn-bnr3.jpeg');">

        </div>
    </div>
    <div class="fashion__slider__content">
        <h4 class="fashion__slider__content__text" data-animation="title">
        Latest Mediterranean Vibes — <br> Explore Our New Collection Now

        </h4>
        <button class="fashion__slider__content__button">
        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">
        Shop Now
    </a>
        </button>
    </div>
</section>

<div class="fashion__title">
        <h4 class="fashion__title--regular" data-animation="title">Uncover charm of Mediterranean and</h4>
        <h4 class="fashion__title--bold" data-animation="title">fashion</h4>
    </div>

    <div class="fashion__products--content">
    <h1 class="fashion__products--heading" data-animation="title">Mediterranean Breeze</h1>
    <div class="fashion__products--paragraph">
        <span class="fashion__products--indented" data-animation="title">Escape into the serene beauty of the Mediterranean </span>
        <span class="fashion__products--indented" data-animation="title">  with our latest linen collection.</span>
        <p data-animation="title">Inspired by the timeless elegance of coastal landscapes <br>
        and the ethereal blue of the sea,<br>
        it brings a touch of refined simplicity to your wardrobe.
        </p>
</div>
</div>

    <div class="fashion__title">
        <h4 class="fashion__title--regular" data-animation="title">See What's New -</h4>
        <h4 class="fashion__title--bold" data-animation="title">Trending Now</h4>
    </div>

<div class="fashion__reveal" data-cursor-text="view">
    <?php
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $loop = new WP_Query($args);

    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
        global $product;
        $image_url = wp_get_attachment_image_url($product->get_image_id(), 'full');
    ?>
        <div class="element__reveal fashion__element__reveal" data-animation="reveal">
            <div class="element__reveal__inner">
                <div class="element__reveal__img fashion__related--image" style="background-image: url('<?php echo esc_url($image_url); ?>');">
                    <!-- Optional content can go here -->
                </div>
            </div>
            <div class="fashion__product-details">
                <h3 class="fashion__product-name"><?php echo get_the_title(); ?></h3>
                <span class="fashion__product-price"><?php echo $product->get_price_html(); ?></span>
                
            </div>
        </div>
    <?php
    endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>

    <div class="fashion__title">
        <h4 class="fashion__title--regular" data-animation="title">Our Signature Capsule -</h4>
        <h4 class="fashion__title--bold" data-animation="title">Key Pieces for the Season</h4>
    </div>

<div class="fashion__reveal" data-cursor-text="view">
    <?php
    $args_capsule = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => 'capsule-collection'
            )
        )
    );
    $loop_capsule = new WP_Query($args_capsule);

    if ($loop_capsule->have_posts()) : while ($loop_capsule->have_posts()) : $loop_capsule->the_post();
        global $product;
        $image_url = wp_get_attachment_image_url($product->get_image_id(), 'full');
    ?>
        <div class="element__reveal fashion__element__reveal" data-animation="reveal">
            <div class="element__reveal__inner">
                <div class="element__reveal__img fashion__related--image" style="background-image: url('<?php echo esc_url($image_url); ?>');">
                </div>
            </div>
            <div class="fashion__product-details">
                <h3 class="fashion__product-name"><?php echo get_the_title(); ?></h3>
                <span class="fashion__product-price"><?php echo $product->get_price_html(); ?></span>
              
            </div>
        </div>
    <?php
    endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>


        <div class="hover__gallery__wrapper" data-cursor-text="shop now">
		    <div class="hover__gallery">
                <a class="hover__gallery__item" data-img="<?php echo esc_url(get_template_directory_uri() . '/images/fshn21.jpeg'); ?>">
                    <span class="hover__gallery__item--text" data-splitting>Dresses</span>
                </a>
                <a class="hover__gallery__item" data-img="<?php echo esc_url(get_template_directory_uri() . '/images/fshn13.jpeg'); ?>"> 
                    <span class="hover__gallery__item--text" data-splitting>Accessories</span>
                </a>
                <a class="hover__gallery__item" data-img="<?php echo esc_url(get_template_directory_uri() . '/images/fshn17.jpeg'); ?>">
                    <span class="hover__gallery__item--text" data-splitting>Pants</span>
                </a>
                <a class="hover__gallery__item" data-img="<?php echo esc_url(get_template_directory_uri() . '/images/fshn8.jpeg'); ?>">
                    <span class="hover__gallery__item--text" data-splitting>Swimwear</span>
                </a>
                <a class="hover__gallery__item" data-img="<?php echo esc_url(get_template_directory_uri() . '/images/fshn22.jpeg'); ?>">
                    <span class="hover__gallery__item--text" data-splitting>Tops</span>
                </a>
                <a class="hover__gallery__item" data-img="<?php echo esc_url(get_template_directory_uri() . '/images/fshn-34.jpg'); ?>">
                    <span class="hover__gallery__item--text" data-splitting>Blazers</span>
                </a>
            </div>
        </div>



    <div class="fashion__products--content">
    <h1 class="fashion__products--heading" data-animation="title">Mediterranean Essence</h1>
    <div class="fashion__products--paragraph">
    <span class="fashion__products--indented" data-animation="title">Introducing the Capsule Collection,</span>
    <span class="fashion__products--indented" data-animation="title">an exclusive selection that embody </span>
    <span class="fashion__products--indented" data-animation="title">the timeless allure of the Mediterranean coast.</span>
    <p data-animation="title">  This collection is meticulously crafted to blend classic styles with modern functionality,
    perfect for the discerning traveler who appreciates elegance and simplicity
    </p>
</div>
</div>

<div class="double-slider__wrapper" data-animation="reveal">


<div class="double-slider double-slider--bg element__reveal__inner">
				<div class="double-slider__item element__reveal__img"><div class="double-slider__item-inner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn-slider1.jpg');"></div></div>
				<div class="double-slider__item"><div class="double-slider__item-inner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn-slider.jpg');"></div></div>
				<div class="double-slider__item"><div class="double-slider__item-inner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn2.jpeg');"></div></div>
				<div class="double-slider__item"><div class="double-slider__item-inner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn4.jpeg');"></div></div>
               
				
			</div>
			<div class="double-slider double-slider--fg">
				<div class="double-slider__item">
					<div class="double-slider__item-inner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn-slider1.jpg');"></div>
				</div>
				<div class="double-slider__item">
					<div class="double-slider__item-inner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn-slider.jpg');"></div>
				</div>
				<div class="double-slider__item">
					<div class="double-slider__item-inner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn2.jpeg');"></div>
				</div>
				<div class="double-slider__item">
					<div class="double-slider__item-inner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn4.jpeg');"></div>
				</div>
				
			</div>
			<div class="type">
				<div class="type__item">Colab x Collection</div>
				<div class="type__item">Linen</div>
				<div class="type__item">White Summer</div>
				<div class="type__item">Events</div>
				<div class="type__item">Capsule</div>
			</div>
			<nav class="double-slider-nav">
				<button class="unbutton double-slider-nav__item double-slider-nav__item--prev"><span>Prev</span></button>
				<button class="unbutton double-slider-nav__item double-slider-nav__item--next"><span>Next</span></button>
			</nav>
          
</div>

<div class="fashion__title">
        <span class="fashion__title--regular" data-animation="title">Check Out Our </span> <br>
        <span class="fashion__title--bold" data-animation="title">Latest News</span>
    </div>


<section class="fashion__content fashion__content--right">
          <div class="fashion__content__wrapper">
            <div class="fashion__content__box">
              <p class="fashion__content__label" data-animation="paragraph">Capsule Essentials</p>
              <div class="fashion__content__description" data-animation="paragraph">
              Introducing our latest capsule collection! This curated selection features minimalist designs with a Mediterranean twist, perfect for any occasion. Get a glimpse of timeless pieces that will elevate your fashion game</div>
            </div>
            <div class="fashion__content__media--right" data-animation="reveal">
                <div class="element__reveal__inner">
                    <div class="fashion__content__media__image element__reveal__img" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn-desc1.jpg');">
                        <!-- Content can go here if needed -->
                    </div>
                </div>
          </div>
        </section>

        <!-- About Content Section -->
        <section class="fashion__content fashion__content--left">
          <div class="fashion__content__wrapper">
            <div class="fashion__content__box">
              <p class="fashion__content__label" data-animation="paragraph">Seasonal Collaboration</p>
              <div class="fashion__content__description" data-animation="paragraph">
              Dive into our exciting new partnership! We've teamed up with a renowned designer to bring fresh Mediterranean vibes to your wardrobe. See how traditional motifs meet contemporary style in this unique collaboration</div>
            </div>
            <div class="fashion__content__media--left" data-animation="reveal">
                <div class="element__reveal__inner">
                    <div class="fashion__content__media__image element__reveal__img" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn-desc2.png');">
                        <!-- Content can go here if needed -->
                    </div>
                </div>
          </div>
          </div>
        </section>

   


    <div class="fashion__title">
        <span class="fashion__title--regular" data-animation="title">Follow Our Style on</span>
        <span class="fashion__title--bold" data-animation="title">Instagram</span>
    </div>

<div class="fashion__reveal--social">
            <div class="element__reveal fashion__element--social" data-animation="reveal" data-cursor-text="follow">
                <div class="element__reveal__inner">
                    <div class="element__reveal__img fashion__related--image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn14.jpeg');">
                    <svg class="fashion__reveal--social--icon"  viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 6.90625C9.28922 6.90625 8.59441 7.11702 8.00342 7.51191C7.41243 7.90679 6.95181 8.46806 6.67981 9.12473C6.40781 9.7814 6.33664 10.504 6.4753 11.2011C6.61397 11.8982 6.95624 12.5386 7.45884 13.0412C7.96143 13.5438 8.60178 13.886 9.29889 14.0247C9.99601 14.1634 10.7186 14.0922 11.3753 13.8202C12.0319 13.5482 12.5932 13.0876 12.9881 12.4966C13.383 11.9056 13.5938 11.2108 13.5938 10.5C13.5938 9.54688 13.2151 8.63279 12.5412 7.95884C11.8672 7.28488 10.9531 6.90625 10 6.90625ZM10 13.1562C9.47464 13.1562 8.96108 13.0005 8.52427 12.7086C8.08745 12.4167 7.74699 12.0019 7.54595 11.5165C7.3449 11.0311 7.2923 10.4971 7.39479 9.98179C7.49728 9.46653 7.75026 8.99323 8.12175 8.62175C8.49323 8.25026 8.96653 7.99728 9.48179 7.89479C9.99705 7.7923 10.5311 7.8449 11.0165 8.04595C11.5019 8.24699 11.9167 8.58745 12.2086 9.02427C12.5005 9.46108 12.6562 9.97464 12.6562 10.5C12.6542 11.2038 12.3737 11.8783 11.876 12.376C11.3783 12.8737 10.7038 13.1542 10 13.1562ZM13.4375 2.84375H6.5625C5.44362 2.84375 4.37056 3.28822 3.57939 4.07939C2.78822 4.87056 2.34375 5.94362 2.34375 7.0625V13.9375C2.34375 15.0564 2.78822 16.1294 3.57939 16.9206C4.37056 17.7118 5.44362 18.1562 6.5625 18.1562H13.4375C14.5564 18.1562 15.6294 17.7118 16.4206 16.9206C17.2118 16.1294 17.6562 15.0564 17.6562 13.9375V7.0625C17.6562 5.94362 17.2118 4.87056 16.4206 4.07939C15.6294 3.28822 14.5564 2.84375 13.4375 2.84375ZM16.7188 13.9375C16.7188 14.8077 16.373 15.6423 15.7577 16.2577C15.1423 16.873 14.3077 17.2188 13.4375 17.2188H6.5625C5.69226 17.2188 4.85766 16.873 4.24231 16.2577C3.62695 15.6423 3.28125 14.8077 3.28125 13.9375V7.0625C3.28125 6.19226 3.62695 5.35766 4.24231 4.74231C4.85766 4.12695 5.69226 3.78125 6.5625 3.78125H13.4375C14.3077 3.78125 15.1423 4.12695 15.7577 4.74231C16.373 5.35766 16.7188 6.19226 16.7188 7.0625V13.9375ZM14.8438 6.4375C14.8438 6.59202 14.7979 6.74306 14.7121 6.87154C14.6262 7.00002 14.5042 7.10015 14.3615 7.15928C14.2187 7.21841 14.0616 7.23388 13.9101 7.20374C13.7585 7.17359 13.6193 7.09919 13.5101 6.98993C13.4008 6.88067 13.3264 6.74146 13.2963 6.58991C13.2661 6.43837 13.2816 6.28128 13.3407 6.13853C13.3998 5.99577 13.5 5.87376 13.6285 5.78791C13.7569 5.70207 13.908 5.65625 14.0625 5.65625C14.2697 5.65625 14.4684 5.73856 14.6149 5.88507C14.7614 6.03159 14.8438 6.2303 14.8438 6.4375Z" fill="currentColor"></path>
                    </svg>
                    </div>
                </div>
            </div>

            <div class="element__reveal fashion__element--social" data-animation="reveal" data-cursor-text="follow">
                <div class="element__reveal__inner">
                    <div class="element__reveal__img fashion__related--image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn6.jpeg');">
                    <svg class="fashion__reveal--social--icon"  viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 6.90625C9.28922 6.90625 8.59441 7.11702 8.00342 7.51191C7.41243 7.90679 6.95181 8.46806 6.67981 9.12473C6.40781 9.7814 6.33664 10.504 6.4753 11.2011C6.61397 11.8982 6.95624 12.5386 7.45884 13.0412C7.96143 13.5438 8.60178 13.886 9.29889 14.0247C9.99601 14.1634 10.7186 14.0922 11.3753 13.8202C12.0319 13.5482 12.5932 13.0876 12.9881 12.4966C13.383 11.9056 13.5938 11.2108 13.5938 10.5C13.5938 9.54688 13.2151 8.63279 12.5412 7.95884C11.8672 7.28488 10.9531 6.90625 10 6.90625ZM10 13.1562C9.47464 13.1562 8.96108 13.0005 8.52427 12.7086C8.08745 12.4167 7.74699 12.0019 7.54595 11.5165C7.3449 11.0311 7.2923 10.4971 7.39479 9.98179C7.49728 9.46653 7.75026 8.99323 8.12175 8.62175C8.49323 8.25026 8.96653 7.99728 9.48179 7.89479C9.99705 7.7923 10.5311 7.8449 11.0165 8.04595C11.5019 8.24699 11.9167 8.58745 12.2086 9.02427C12.5005 9.46108 12.6562 9.97464 12.6562 10.5C12.6542 11.2038 12.3737 11.8783 11.876 12.376C11.3783 12.8737 10.7038 13.1542 10 13.1562ZM13.4375 2.84375H6.5625C5.44362 2.84375 4.37056 3.28822 3.57939 4.07939C2.78822 4.87056 2.34375 5.94362 2.34375 7.0625V13.9375C2.34375 15.0564 2.78822 16.1294 3.57939 16.9206C4.37056 17.7118 5.44362 18.1562 6.5625 18.1562H13.4375C14.5564 18.1562 15.6294 17.7118 16.4206 16.9206C17.2118 16.1294 17.6562 15.0564 17.6562 13.9375V7.0625C17.6562 5.94362 17.2118 4.87056 16.4206 4.07939C15.6294 3.28822 14.5564 2.84375 13.4375 2.84375ZM16.7188 13.9375C16.7188 14.8077 16.373 15.6423 15.7577 16.2577C15.1423 16.873 14.3077 17.2188 13.4375 17.2188H6.5625C5.69226 17.2188 4.85766 16.873 4.24231 16.2577C3.62695 15.6423 3.28125 14.8077 3.28125 13.9375V7.0625C3.28125 6.19226 3.62695 5.35766 4.24231 4.74231C4.85766 4.12695 5.69226 3.78125 6.5625 3.78125H13.4375C14.3077 3.78125 15.1423 4.12695 15.7577 4.74231C16.373 5.35766 16.7188 6.19226 16.7188 7.0625V13.9375ZM14.8438 6.4375C14.8438 6.59202 14.7979 6.74306 14.7121 6.87154C14.6262 7.00002 14.5042 7.10015 14.3615 7.15928C14.2187 7.21841 14.0616 7.23388 13.9101 7.20374C13.7585 7.17359 13.6193 7.09919 13.5101 6.98993C13.4008 6.88067 13.3264 6.74146 13.2963 6.58991C13.2661 6.43837 13.2816 6.28128 13.3407 6.13853C13.3998 5.99577 13.5 5.87376 13.6285 5.78791C13.7569 5.70207 13.908 5.65625 14.0625 5.65625C14.2697 5.65625 14.4684 5.73856 14.6149 5.88507C14.7614 6.03159 14.8438 6.2303 14.8438 6.4375Z" fill="currentColor"></path>
                    </svg>
                    </div>
                </div>
            </div>

            <div class="element__reveal fashion__element--social" data-animation="reveal" data-cursor-text="follow">
                <div class="element__reveal__inner">
                    <div class="element__reveal__img fashion__related--image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn32.jpeg');">
                    <svg class="fashion__reveal--social--icon"  viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 6.90625C9.28922 6.90625 8.59441 7.11702 8.00342 7.51191C7.41243 7.90679 6.95181 8.46806 6.67981 9.12473C6.40781 9.7814 6.33664 10.504 6.4753 11.2011C6.61397 11.8982 6.95624 12.5386 7.45884 13.0412C7.96143 13.5438 8.60178 13.886 9.29889 14.0247C9.99601 14.1634 10.7186 14.0922 11.3753 13.8202C12.0319 13.5482 12.5932 13.0876 12.9881 12.4966C13.383 11.9056 13.5938 11.2108 13.5938 10.5C13.5938 9.54688 13.2151 8.63279 12.5412 7.95884C11.8672 7.28488 10.9531 6.90625 10 6.90625ZM10 13.1562C9.47464 13.1562 8.96108 13.0005 8.52427 12.7086C8.08745 12.4167 7.74699 12.0019 7.54595 11.5165C7.3449 11.0311 7.2923 10.4971 7.39479 9.98179C7.49728 9.46653 7.75026 8.99323 8.12175 8.62175C8.49323 8.25026 8.96653 7.99728 9.48179 7.89479C9.99705 7.7923 10.5311 7.8449 11.0165 8.04595C11.5019 8.24699 11.9167 8.58745 12.2086 9.02427C12.5005 9.46108 12.6562 9.97464 12.6562 10.5C12.6542 11.2038 12.3737 11.8783 11.876 12.376C11.3783 12.8737 10.7038 13.1542 10 13.1562ZM13.4375 2.84375H6.5625C5.44362 2.84375 4.37056 3.28822 3.57939 4.07939C2.78822 4.87056 2.34375 5.94362 2.34375 7.0625V13.9375C2.34375 15.0564 2.78822 16.1294 3.57939 16.9206C4.37056 17.7118 5.44362 18.1562 6.5625 18.1562H13.4375C14.5564 18.1562 15.6294 17.7118 16.4206 16.9206C17.2118 16.1294 17.6562 15.0564 17.6562 13.9375V7.0625C17.6562 5.94362 17.2118 4.87056 16.4206 4.07939C15.6294 3.28822 14.5564 2.84375 13.4375 2.84375ZM16.7188 13.9375C16.7188 14.8077 16.373 15.6423 15.7577 16.2577C15.1423 16.873 14.3077 17.2188 13.4375 17.2188H6.5625C5.69226 17.2188 4.85766 16.873 4.24231 16.2577C3.62695 15.6423 3.28125 14.8077 3.28125 13.9375V7.0625C3.28125 6.19226 3.62695 5.35766 4.24231 4.74231C4.85766 4.12695 5.69226 3.78125 6.5625 3.78125H13.4375C14.3077 3.78125 15.1423 4.12695 15.7577 4.74231C16.373 5.35766 16.7188 6.19226 16.7188 7.0625V13.9375ZM14.8438 6.4375C14.8438 6.59202 14.7979 6.74306 14.7121 6.87154C14.6262 7.00002 14.5042 7.10015 14.3615 7.15928C14.2187 7.21841 14.0616 7.23388 13.9101 7.20374C13.7585 7.17359 13.6193 7.09919 13.5101 6.98993C13.4008 6.88067 13.3264 6.74146 13.2963 6.58991C13.2661 6.43837 13.2816 6.28128 13.3407 6.13853C13.3998 5.99577 13.5 5.87376 13.6285 5.78791C13.7569 5.70207 13.908 5.65625 14.0625 5.65625C14.2697 5.65625 14.4684 5.73856 14.6149 5.88507C14.7614 6.03159 14.8438 6.2303 14.8438 6.4375Z" fill="currentColor"></path>
                    </svg>
                    </div>
                </div>
            </div>
                
            <div class="element__reveal fashion__element--social" data-animation="reveal" data-cursor-text="follow">
                <div class="element__reveal__inner">
                    <div class="element__reveal__img fashion__related--image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fshn9.jpeg');">
                    <svg class="fashion__reveal--social--icon"  viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 6.90625C9.28922 6.90625 8.59441 7.11702 8.00342 7.51191C7.41243 7.90679 6.95181 8.46806 6.67981 9.12473C6.40781 9.7814 6.33664 10.504 6.4753 11.2011C6.61397 11.8982 6.95624 12.5386 7.45884 13.0412C7.96143 13.5438 8.60178 13.886 9.29889 14.0247C9.99601 14.1634 10.7186 14.0922 11.3753 13.8202C12.0319 13.5482 12.5932 13.0876 12.9881 12.4966C13.383 11.9056 13.5938 11.2108 13.5938 10.5C13.5938 9.54688 13.2151 8.63279 12.5412 7.95884C11.8672 7.28488 10.9531 6.90625 10 6.90625ZM10 13.1562C9.47464 13.1562 8.96108 13.0005 8.52427 12.7086C8.08745 12.4167 7.74699 12.0019 7.54595 11.5165C7.3449 11.0311 7.2923 10.4971 7.39479 9.98179C7.49728 9.46653 7.75026 8.99323 8.12175 8.62175C8.49323 8.25026 8.96653 7.99728 9.48179 7.89479C9.99705 7.7923 10.5311 7.8449 11.0165 8.04595C11.5019 8.24699 11.9167 8.58745 12.2086 9.02427C12.5005 9.46108 12.6562 9.97464 12.6562 10.5C12.6542 11.2038 12.3737 11.8783 11.876 12.376C11.3783 12.8737 10.7038 13.1542 10 13.1562ZM13.4375 2.84375H6.5625C5.44362 2.84375 4.37056 3.28822 3.57939 4.07939C2.78822 4.87056 2.34375 5.94362 2.34375 7.0625V13.9375C2.34375 15.0564 2.78822 16.1294 3.57939 16.9206C4.37056 17.7118 5.44362 18.1562 6.5625 18.1562H13.4375C14.5564 18.1562 15.6294 17.7118 16.4206 16.9206C17.2118 16.1294 17.6562 15.0564 17.6562 13.9375V7.0625C17.6562 5.94362 17.2118 4.87056 16.4206 4.07939C15.6294 3.28822 14.5564 2.84375 13.4375 2.84375ZM16.7188 13.9375C16.7188 14.8077 16.373 15.6423 15.7577 16.2577C15.1423 16.873 14.3077 17.2188 13.4375 17.2188H6.5625C5.69226 17.2188 4.85766 16.873 4.24231 16.2577C3.62695 15.6423 3.28125 14.8077 3.28125 13.9375V7.0625C3.28125 6.19226 3.62695 5.35766 4.24231 4.74231C4.85766 4.12695 5.69226 3.78125 6.5625 3.78125H13.4375C14.3077 3.78125 15.1423 4.12695 15.7577 4.74231C16.373 5.35766 16.7188 6.19226 16.7188 7.0625V13.9375ZM14.8438 6.4375C14.8438 6.59202 14.7979 6.74306 14.7121 6.87154C14.6262 7.00002 14.5042 7.10015 14.3615 7.15928C14.2187 7.21841 14.0616 7.23388 13.9101 7.20374C13.7585 7.17359 13.6193 7.09919 13.5101 6.98993C13.4008 6.88067 13.3264 6.74146 13.2963 6.58991C13.2661 6.43837 13.2816 6.28128 13.3407 6.13853C13.3998 5.99577 13.5 5.87376 13.6285 5.78791C13.7569 5.70207 13.908 5.65625 14.0625 5.65625C14.2697 5.65625 14.4684 5.73856 14.6149 5.88507C14.7614 6.03159 14.8438 6.2303 14.8438 6.4375Z" fill="currentColor"></path>
                    </svg>>
                    </div>
                </div>
            </div>  
    </div>

      
<?php get_footer(); ?>
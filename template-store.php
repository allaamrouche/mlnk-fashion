<?php
/*
Template Name: Store Page
*/
get_header();

?>

<div id="content" class="content" data-template="store">
<div class="store" data-background="#edeee9" data-color="#111">
        <div class="store__wrapper">

        <section class="store__slider">
        <figure class="store__slider__media">
            <?php $content_image = 'images/mlnk7.jpeg'; ?>
            <img class="store__slider__media__image" data-src="<?php echo esc_url(get_template_directory_uri() . '/' . $content_image); ?>" alt="Second Content Featured Image">
        </figure>
          <div class="store__slider__content">
            <h4 class="store__slider__content__text" data-animation="title">
              Beauty that cares <br> for the planet
            </h4>
            <button class="store__slider__content__button">
              Shop Green 
            </button>
          </div>
        </section>

        <section class="store__highlight">
            <div class="store__highlight__wrapper">
                <p class="store__highlight__content__label" data-animation="paragraph">Article Label</p>
                <h2 class="store__highlight__title" data-animation="title">Evokes Beauty <br> and Luxury</h2>
                <div class="store__highlight__content__description" data-animation="paragraph">The name should reflect the essence of your cosmetic brand. It should convey the style, values, and unique selling points of your products. For example, if your brand focuses on natural and organic cosmetics, the name should hint at this</div>
                <div class="store__highlight__medias">
                <figure class="store__highlight__media">
                    <?php $content_image = 'images/mlnk.jpeg'; ?>
                    <img class="store__highlight__media__image" data-src="<?php echo esc_url(get_template_directory_uri() . '/' . $content_image); ?>" alt="Second Content Featured Image">
                  </figure>
                  <figure class="store__highlight__media">
                    <?php $content_image = 'images/mlnk7.jpeg'; ?>
                    <img class="store__highlight__media__image" data-src="<?php echo esc_url(get_template_directory_uri() . '/' . $content_image); ?>" alt="Second Content Featured Image">
                  </figure>
                  <figure class="store__highlight__media">
                    <?php $content_image = 'images/mlnk10.jpeg'; ?>
                    <img class="store__highlight__media__image" data-src="<?php echo esc_url(get_template_directory_uri() . '/' . $content_image); ?>" alt="Second Content Featured Image">
                  </figure>
                  <figure class="store__highlight__media">
                    <?php $content_image = 'images/mlnk11.jpeg'; ?>
                    <img class="store__highlight__media__image" data-src="<?php echo esc_url(get_template_directory_uri() . '/' . $content_image); ?>" alt="Second Content Featured Image">
                  </figure>
                </div>
            </div>
        </section>



        <div class="store__gallery">
           <div class="store__gallery__wrapper">

            <div class="store__gallery__item">
                <a href="/detail" class="store__gallery__link">
                    <figure class="store__gallery__media">
                        <img class="store__gallery__media__image" data-src="<?php echo get_template_directory_uri(); ?>/images/mlnk6.jpeg" alt="Service Image" >
                    </figure>
                </a>
            </div>

            <div class="store__gallery__item">
                <a href="/detail" class="store__gallery__link">
                    <figure class="store__gallery__media">
                        <img class="store__gallery__media__image" data-src="<?php echo get_template_directory_uri(); ?>/images/mlnk7.jpeg" alt="Service Image" >
                    </figure>
                </a>
            </div>

            <div class="store__gallery__item">
                <a href="/detail" class="store__gallery__link">
                    <figure class="store__gallery__media">
                        <img class="store__gallery__media__image" data-src="<?php echo get_template_directory_uri(); ?>/images/mlnk8.jpeg" alt="Service Image" >
                    </figure>
                </a>
            </div>

            <div class="store__gallery__item">
                <a href="/detail" class="store__gallery__link">
                    <figure class="store__gallery__media">
                        <img class="store__gallery__media__image" data-src="<?php echo get_template_directory_uri(); ?>/images/mlnk9.jpeg" alt="Service Image" >
                    </figure>
                </a>
            </div>       

            <div class="store__gallery__item">
                <a href="/detail" class="store__gallery__link">
                    <figure class="store__gallery__media">
                        <img class="store__gallery__media__image" data-src="<?php echo get_template_directory_uri(); ?>/images/mlnk6.jpeg" alt="Service Image" >
                    </figure>
                </a>
            </div>

            <div class="store__gallery__item">
                <a href="/detail" class="store__gallery__link">
                    <figure class="store__gallery__media">
                        <img class="store__gallery__media__image" data-src="<?php echo get_template_directory_uri(); ?>/images/mlnk7.jpeg" alt="Service Image" >
                    </figure>
                </a>
            </div>

            <div class="store__gallery__item">
                <a href="/detail" class="store__gallery__link">
                    <figure class="store__gallery__media">
                        <img class="store__gallery__media__image" data-src="<?php echo get_template_directory_uri(); ?>/images/mlnk8.jpeg" alt="Service Image" >
                    </figure>
                </a>
            </div>

            <div class="store__gallery__item">
                <a href="/detail" class="store__gallery__link">
                    <figure class="store__gallery__media">
                        <img class="store__gallery__media__image" data-src="<?php echo get_template_directory_uri(); ?>/images/mlnk9.jpeg" alt="Service Image" >
                    </figure>
                </a>
            </div>    
          </div>
        </div>
       
        <section class="store__highlight">
            <div class="store__highlight__wrapper">
                <p class="store__highlight__content__label" data-animation="paragraph">Article Label</p>
                <h2 class="store__highlight__title" data-animation="title">Evokes Beauty <br> and Luxury</h2>
                <div class="store__highlight__content__description" data-animation="paragraph">The name should reflect the essence of your cosmetic brand. It should convey the style, values, and unique selling points of your products. For example, if your brand focuses on natural and organic cosmetics, the name should hint at this</div>
                <div class="store__highlight__medias">
                <figure class="store__highlight__media">
                    <?php $content_image = 'images/mlnk.jpeg'; ?>
                    <img class="store__highlight__media__image" data-src="<?php echo esc_url(get_template_directory_uri() . '/' . $content_image); ?>" alt="Second Content Featured Image">
                  </figure>
                  <figure class="store__highlight__media">
                    <?php $content_image = 'images/mlnk7.jpeg'; ?>
                    <img class="store__highlight__media__image" data-src="<?php echo esc_url(get_template_directory_uri() . '/' . $content_image); ?>" alt="Second Content Featured Image">
                  </figure>
                  <figure class="store__highlight__media">
                    <?php $content_image = 'images/mlnk10.jpeg'; ?>
                    <img class="store__highlight__media__image" data-src="<?php echo esc_url(get_template_directory_uri() . '/' . $content_image); ?>" alt="Second Content Featured Image">
                  </figure>
                  <figure class="store__highlight__media">
                    <?php $content_image = 'images/mlnk11.jpeg'; ?>
                    <img class="store__highlight__media__image" data-src="<?php echo esc_url(get_template_directory_uri() . '/' . $content_image); ?>" alt="Second Content Featured Image">
                  </figure>
                </div>
            </div>
        </section>
      

        </div>
    </div>
        

<?php get_footer(); ?>
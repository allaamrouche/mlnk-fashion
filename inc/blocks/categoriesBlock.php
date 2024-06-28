<?php

function malanka_register_product_category_block() {
    register_block_type('malanka/product-category-block', array(
        'render_callback' => 'malanka_render_product_category_block',
        'attributes' => array(
            'categorySlug' => array(
                'type' => 'string',
                'default' => 'default-category',
            ),
            'numberOfProducts' => array(
                'type' => 'number',
                'default' => 4,
            ),
        ),
    ));
}

function malanka_render_product_category_block($attributes) {
    error_log('Using category slug: ' . $attributes['categorySlug']);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $attributes['numberOfProducts'],
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $attributes['categorySlug']
            )
        )
    );
    $loop = new WP_Query($args);

    ob_start();
    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
        global $product;
        $image_url = wp_get_attachment_image_url($product->get_image_id(), 'full');
        ?>
        <div class="element__reveal fashion__element__reveal" data-animation="reveal">
            <div class="element__reveal__inner">
                <div class="element__reveal__img fashion__related--image" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
            </div>
            <div class="fashion__product-details">
                <h3 class="fashion__product-name"><?php the_title(); ?></h3>
                <span class="fashion__product-price"><?php echo $product->get_price_html(); ?></span>
            </div>
        </div>
        <?php
    endwhile; endif;
    wp_reset_postdata();

    return ob_get_clean();
}

add_action('init', 'malanka_register_product_category_block');

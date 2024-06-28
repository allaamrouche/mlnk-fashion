<?php
/*
Template Name: Favorite Products Page
*/

get_header();

// Check if WooCommerce is active
if (!function_exists('wc_get_product')) {
    echo '<p>WooCommerce must be installed and active.</p>';
    get_footer();
    exit;
}

$current_user_favorites = get_user_favorites();
?>

<div id="content" class="content" data-template="favorites">
    <div class="favorites" data-background="#edeee9" data-color="#111">
        <div class="favorites__wrapper">

            <div class="favorites__products">
            <?php foreach ($current_user_favorites as $product): ?>
                <div class="favorites__product" data-animation="reveal">
                    <div class="favorites__inner element__reveal__inner">
                        <!-- Display product thumbnail as background image -->
                        <div class="favorites__media__image element__reveal__img" style="background-image: url('<?php echo wp_get_attachment_url($product->get_image_id()); ?>');"></div>
                    </div>
                    <div class="favorites__content">
                        <div class="favorites__content--heading">
                        <!-- Product Title -->
                        <h3><?php echo $product->get_title(); ?></h3>
                        <!-- Product Price -->
                        <p><?php echo $product->get_price_html(); ?></p>
                        </div>
                        <!-- Product Rating -->
                        <div class="favorites__content--buttons">
                        <?php if ($rating_html = wc_get_rating_html($product->get_average_rating())): ?>
                            <div class="product-rating"><?php echo $rating_html; ?></div>
                        <?php endif; ?>
                        <!-- Add to Cart Button -->
                        <a href="<?php echo $product->add_to_cart_url(); ?>" class="button add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product->get_id(); ?>">Add to Cart</a>
                        <!-- Remove from Favorites Link -->
                        <a href="?remove_favorite=<?php echo $product->get_id(); ?>" class="button remove-favorite">Remove</a>
                    </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


<?php get_footer(); ?>

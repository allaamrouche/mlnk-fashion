<?php
defined('ABSPATH') || exit;

global $product;
$is_favorited = in_array($product->get_id(), get_user_favorites_ids());

if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('', $product); ?>>
    <div class="element__reveal" data-animation="reveal">
        <div class="element__reveal__inner">
            <div class="element__reveal__img" style="background-image: url('<?php echo get_the_post_thumbnail_url($product->get_id()); ?>');">
            </div> <!-- /.element__reveal__img -->
   
        <?php do_action('woocommerce_before_shop_loop_item'); ?>

        <div class="product-info">
       
            <?php do_action('woocommerce_before_shop_loop_item_title'); ?>
            
            <div class="product__heading">
                <?php do_action('woocommerce_shop_loop_item_title'); ?>
                
                <svg width="18" height="18" viewBox="0 0 24 24" class="favorites-icon" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                    <path class="favorites-icon-path" stroke="#111" fill="<?php echo $is_favorited ? '#111' : 'none'; ?>" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                </svg>
                
            </div> <!-- /.product__heading -->
            
            <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
        </div> <!-- /.product-info -->
      
        <?php do_action('woocommerce_after_shop_loop_item'); ?>
    </div> <!-- /.element__reveal__inner -->
</div> <!-- /.element__reveal -->
</li>
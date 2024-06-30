<?php
defined('ABSPATH') || exit;

global $product;

$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();

$main_image_url = '';
$thumbnails_html = '';

if ($post_thumbnail_id) {
    $main_image_url = wp_get_attachment_url($post_thumbnail_id);
}

if ($attachment_ids && !empty($attachment_ids)) {
    $counter = 0;
    foreach ($attachment_ids as $attachment_id) {
        if ($counter >= 3)
            break;
        $image_url = wp_get_attachment_url($attachment_id);
        $thumbnails_html .= '<div class="element__reveal product-single--thumbnails woocommerce-product-gallery__image" data-animation="reveal">
                                 <div class="element__reveal__inner">
                                     <div class="element__reveal__img product-single--thumbnails-image" style="background-image: url(\'' . esc_url($image_url) . '\');"></div>
                                 </div>
                             </div>';
        $counter++;
    }
}
?>

<div class="woocommerce-product-gallery product-single--gallery">
    <!-- Main image -->
    <div class="element__reveal product-single--image main-image" data-animation="reveal">
        <div class="element__reveal__inner">
            <div class="element__reveal__img product-single--image-media" style="background-image: url('<?php echo esc_url($main_image_url); ?>');">
            </div>
        </div>
    </div>
    <!-- Thumbnails -->
    <div class="product-single--thumbnails">
        <?php echo $thumbnails_html; ?>
    </div>
</div>
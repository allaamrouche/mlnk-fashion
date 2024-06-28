<?php
// Remove the related products from their original position
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Add the related products to a new location. You need to find the right hook where you want it to appear.
// For example, to add it outside the product div, you might use 'woocommerce_after_single_product'.
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 5 );




add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

add_filter('woocommerce_product_tabs', 'custom_filter_woocommerce_product_tabs', 98);

function custom_filter_woocommerce_product_tabs($tabs) {
    unset($tabs['description']); 
    
    return $tabs;
}

add_action('woocommerce_single_product_summary', 'woocommerce_product_description_tab', 25);
// add_action('woocommerce_single_product_summary', 'woocommerce_product_additional_information_tab', 26);


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
// remove_action('woocommerce_single_product_summary', 'woocommerce_single_product_summary', 30);


function custom_woocommerce_show_product_category() {
    global $product;
    $categories_list = wc_get_product_category_list($product->get_id());
    
    // Check if the categories list is not empty before processing
    if (!empty($categories_list)) {
        $categories_list_with_class = preg_replace('/<a /', '<a class="product-single--category" ', $categories_list);
        echo $categories_list_with_class;
    }
}



add_action('woocommerce_single_product_summary', 'custom_woocommerce_show_product_category', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20); 
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_product_description_tab', 25); 


// Ensure the variations and add-to-cart form is displayed for variable products
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

// variations product dropdown
function wc_buttons_variation_attribute_options($args = array()) {
    $args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
        'options'          => false,
        'attribute'        => false,
        'product'          => false,
        'selected'         => false,
        'name'             => '',
        'id'               => '',
    ));

    $options   = $args['options'];
    $product   = $args['product'];
    $attribute = $args['attribute'];
    $name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
    $id        = $args['id'] ? $args['id'] : sanitize_title($attribute);
    $selected  = $args['selected'];

    if (empty($options) && !empty($product) && !empty($attribute)) {
        $attributes = $product->get_variation_attributes();
        $options    = $attributes[$attribute];
    }

    if (!empty($options)) {
        // Render hidden select
        echo '<select id="' . esc_attr($id) . '" name="' . esc_attr($name) . '" style="display:none;">';
        foreach ($options as $option) {
            echo '<option value="' . esc_attr($option) . '"' . selected($selected, $option, false) . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option)) . '</option>';
        }
        echo '</select>';

        // Render buttons for visual selection
        echo '<div id="div_' . esc_attr($id) . '" class="attribute-options">';
        foreach ($options as $option) {
            $checked = checked($selected, $option, false);
            echo '<button type="button" class="attribute-option' . ($checked ? ' selected' : '') . '" data-value="' . esc_attr($option) . '">' . esc_html(apply_filters('woocommerce_variation_option_name', $option)) . '</button>';
        }
        echo '</div>';
    }
}

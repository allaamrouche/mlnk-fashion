<?php
require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/editor/editor-setup.php';
require get_template_directory() . '/inc/malanka-overlay-navigation.php';
require get_template_directory() . '/inc/malanka-navigation.php';
require get_template_directory() . '/inc/woocommerce/woocommerce-hooks.php';
require get_template_directory() . '/inc/customizer.php';


function malanka_register_blocks() {
    register_block_type('malanka/fashion-category-products', array(
        'render_callback' => 'malanka_render_category_products_block'
    ));
}
add_action('init', 'malanka_register_blocks');

function malanka_render_category_products_block($attributes) {
    if (empty($attributes['selectedCategory'])) {
        return 'Please select a category.';
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $attributes['selectedCategory']
            )
        )
    );
    $query = new WP_Query($args);
    $output = '<div class="fashion__reveal" data-cursor-text="view">';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            $image_url = get_the_post_thumbnail_url($product->get_id(), 'full');

            $output .= '<div class="element__reveal fashion__element__reveal" data-animation="reveal">
                <div class="element__reveal__inner">
                    <div class="element__reveal__img fashion__related--image" style="background-image: url(' . esc_url($image_url) . ');"></div>
                </div>
                <div class="fashion__product-details">
                    <h3 class="fashion__product-name">' . get_the_title() . '</h3>
                    <span class="fashion__product-price">' . $product->get_price_html() . '</span>
                </div>
            </div>';
        }
        wp_reset_postdata();
    } else {
        $output .= 'No products found in this category.';
    }

    $output .= '</div>';
    return $output;
}


function handle_favorite_toggle() {
    // Set proper headers for JSON response
    header('Content-Type: application/json');

    // Check nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'favorite_nonce')) {
        echo json_encode(['success' => false, 'message' => 'Nonce verification failed']);
        exit;
    }

    // Validate product ID
    if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
        exit;
    }

    $product_id = intval($_POST['product_id']);
    $user_id = get_current_user_id();

    // Check if the user is logged in
    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'You must be logged in to add items to favorites.']);
        exit;
    }

    $favorites = get_user_meta($user_id, 'favorite_products', true);
    $favorites = $favorites ? explode(',', $favorites) : [];

    if (in_array($product_id, $favorites)) {
        $favorites = array_diff($favorites, array($product_id)); // Remove product from favorites
        $is_favorited = false;
    } else {
        $favorites[] = $product_id; // Add product to favorites
        $is_favorited = true;
    }

    // Update the user meta with the new favorites list
    update_user_meta($user_id, 'favorite_products', implode(',', $favorites));

    // Send back a success response with the favorited status
    echo json_encode(['success' => true, 'is_favorited' => $is_favorited]);
    exit;
}
add_action('wp_ajax_toggle_favorite', 'handle_favorite_toggle');
add_action('wp_ajax_nopriv_toggle_favorite', 'handle_favorite_toggle');

function get_user_favorites_ids() {
    $user_id = get_current_user_id();
    if (!$user_id) {
        return []; // Handle non-logged in user scenario appropriately
    }
    $favorites = get_user_meta($user_id, 'favorite_products', true);
    $favorites_array = $favorites ? explode(',', $favorites) : [];
    return array_unique($favorites_array); // Remove any duplicate IDs
}


function get_user_favorites() {
    $favorites_ids = get_user_favorites_ids();
    $favorites = [];
    foreach ($favorites_ids as $id) {
        $product = wc_get_product($id);
        if ($product) {
            $favorites[] = $product;
        }
    }
    return $favorites;
}


add_action('init', 'handle_remove_favorite');
function handle_remove_favorite() {
    if (isset($_GET['remove_favorite'])) {
        $product_id = intval($_GET['remove_favorite']);
        $user_id = get_current_user_id();
        if ($user_id && $product_id) {
            $favorites = get_user_favorites_ids();
            $new_favorites = array_diff($favorites, array($product_id));
            update_user_meta($user_id, 'favorite_products', implode(',', $new_favorites));
            // Optionally redirect to avoid resubmission
            wp_redirect(remove_query_arg('remove_favorite'));
            exit;
        }
    }
}




// dropdown
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


add_action( 'woocommerce_before_shop_loop', 'custom_woocommerce_catalog_ordering', 30 );

function custom_woocommerce_catalog_ordering() {
    if (!woocommerce_products_will_display())
        return;

    echo '<form class="woocommerce-ordering" method="get">';
    echo '<div class="custom-dropdown">
            <div class="custom-dropdown__selected">Select an Option</div>
            <ul class="custom-dropdown__list" style="display:none;">';
    $options = [
        'menu_order' => 'Default sorting',
        'popularity' => 'Sort by popularity',
        'rating' => 'Sort by average rating',
        'date' => 'Sort by latest',
        'price' => 'Sort by price: low to high',
        'price-desc' => 'Sort by price: high to low'
    ];
    foreach ($options as $value => $label) {
        echo sprintf('<li data-value="%s">%s</li>', $value, $label);
    }
    echo '</ul></div>';

    echo '<select name="orderby" class="orderby dropdown__select" aria-label="Shop order" style="display:none;">';
    $current_orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'menu_order';
    foreach ($options as $value => $label) {
        echo sprintf('<option value="%s"%s>%s</option>', $value, selected($current_orderby, $value, false), $label);
    }
    echo '</select>';
    wc_query_string_form_fields(null, ['orderby', 'submit', 'paged', 'product-page']);
    echo '</form>';
}

// function custom_woocommerce_catalog_ordering() {
//     // Only display the custom dropdown if products will be displayed
//     if (!woocommerce_products_will_display())
//         return;

//     echo '<div class="custom-dropdown">
//             <div class="custom-dropdown__selected">Select an Option</div>
//             <ul class="custom-dropdown__list">
//                 <li data-value="menu_order">Default Sorting</li>
//                 <li data-value="popularity">Sort by Popularity</li>
//                 <li data-value="rating">Sort by Average Rating</li>
//                 <li data-value="date">Sort by Latest</li>
//                 <li data-value="price">Sort by Price: Low to High</li>
//                 <li data-value="price-desc">Sort by Price: High to Low</li>
//             </ul>
//           </div>';
//     echo '<select name="orderby" class="orderby dropdown__select" aria-label="Shop order" style="display:none;">';
//     // Get the current selected value
//     $current_orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'menu_order';
//     $options = array(
//         'menu_order' => 'Default sorting',
//         'popularity' => 'Sort by popularity',
//         'rating' => 'Sort by average rating',
//         'date' => 'Sort by latest',
//         'price' => 'Sort by price: low to high',
//         'price-desc' => 'Sort by price: high to low'
//     );

//     foreach ($options as $value => $label) {
//         echo sprintf('<option value="%s"%s>%s</option>', $value, selected($current_orderby, $value, false), $label);
//     }

//     echo '</select>';
//     // Include any additional query string parameters to preserve when the form is submitted
//     wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page'));
// }

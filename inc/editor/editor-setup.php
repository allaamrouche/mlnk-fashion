<?php

function malanka_enqueue_editor_scripts() {
    wp_enqueue_script(
        'malanka-editor-script', 
        get_template_directory_uri() . '/assets/js/editor.js', // Path to the bundled script.
        array('wp-blocks', 'wp-element', 'wp-components', 'wp-editor', 'wp-data'), // Dependencies.
        filemtime(get_template_directory() . '/assets/js/editor.js'), // Versioning by file modification time to help with cache busting.
        true 
    );

    if (is_admin()) {
        wp_enqueue_media();
    }
}

add_action('enqueue_block_editor_assets', 'malanka_enqueue_editor_scripts');
add_action('admin_enqueue_scripts', 'malanka_enqueue_admin_scripts');



function save_custom_menu_item_fields($menu_id, $menu_item_db_id) {
    if (isset($_POST['menu-item-image'][$menu_item_db_id])) {
        $image_url = sanitize_text_field($_POST['menu-item-image'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_image_url', $image_url);
    }
}
add_action('wp_update_nav_menu_item', 'save_custom_menu_item_fields', 10, 2);


function malanka_add_custom_fields_to_menu($item_id, $item, $depth, $args) {
    // Retrieve the image URL from the database
    $image_url = get_post_meta($item_id, '_menu_item_image_url', true);

    ?>
    <p class="field-custom description description-wide">
        <label for="edit-menu-item-image-<?php echo $item_id; ?>">
            <?php _e('Image for Menu Item', 'text-domain'); ?><br>
            <input type="text" name="menu-item-image[<?php echo $item_id; ?>]" id="edit-menu-item-image-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" value="<?php echo esc_attr($image_url); ?>">
            <button type="button" class="upload_image_button button add_media">Upload Image</button>
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'malanka_add_custom_fields_to_menu', 10, 4);

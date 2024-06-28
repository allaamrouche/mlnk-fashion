<?php
class Malanka_Overlay_Nav_Walker extends Walker_Nav_Menu {
    // Start Level
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Intentionally left empty
    }

    // End Level
    function end_lvl(&$output, $depth = 0, $args = null) {
        // Intentionally left empty
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $url = esc_url($item->url);
        $title = apply_filters('the_title', $item->title, $item->ID);
        
        // Retrieve the image URL from the post meta
        $image_url = get_post_meta($item->ID, '_menu_item_image_url', true);
    
        $output .= "<a class='navigation__overlay__item' href='{$url}' data-img-url='{$image_url}'>";
        $output .= "<span class='navigation__overlay__item-text'><span class='navigation__overlay__item-textinner'>{$title}</span></span>";
        $output .= "</a>";
    }
    

    // End Element
    function end_el(&$output, $item, $depth = 0, $args = null) {
        // Intentionally left empty
    }
}
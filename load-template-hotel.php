<?php
function get_custom_post_type_single_template_hotel($single_template) {
    global $post;

    if ($post->post_type == 'hotel') {
        $single_template = plugin_dir_path( __FILE__ ) . 'template-hotel/single-hotel.php';
    }
    return $single_template;
}

function get_custom_post_type_archive_template_hotel($archive_template) {
    global $post;

    if ($post->post_type == 'hotel') {
        $archive_template = plugin_dir_path( __FILE__ ) . 'template-hotel/archive-hotel.php';
    }
    return $archive_template;
}

function get_custom_post_type_category_template_hotel($category_template) {
    global $post;

    if ($post->post_type == 'hotel') {
        $category_template = plugin_dir_path( __FILE__ )  . '/template-hotel/category-hotel.php';
    }
    return $category_template;
}

add_filter( 'single_template', 'get_custom_post_type_single_template_hotel' );
add_filter( 'archive_template', 'get_custom_post_type_archive_template_hotel' );
add_filter( 'category_template', 'get_custom_post_type_category_template_hotel' );

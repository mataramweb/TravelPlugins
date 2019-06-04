<?php
function get_custom_post_type_single_template_transport($single_template) {
    global $post;

    if ($post->post_type == 'transport') {
        $single_template = plugin_dir_path( __FILE__ ) . 'template-transport/single-transport.php';
    }
    return $single_template;
}

function get_custom_post_type_archive_template_transport($archive_template) {
    global $post;

    if ($post->post_type == 'transport') {
        $archive_template = plugin_dir_path( __FILE__ ) . 'template-transport/archive-transport.php';
    }
    return $archive_template;
}

function get_custom_post_type_category_template_transport($category_template) {
    global $post;

    if ($post->post_type == 'transport') {
        $category_template = plugin_dir_path( __FILE__ )  . '/template-transport/category-transport.php';
    }
    return $category_template;
}

add_filter( 'single_template', 'get_custom_post_type_single_template_transport' );
add_filter( 'archive_template', 'get_custom_post_type_archive_template_transport' );
add_filter( 'category_template', 'get_custom_post_type_category_template_transport' );
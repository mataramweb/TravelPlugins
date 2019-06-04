<?php
function get_custom_post_type_single_template($single_template) {
    global $post;

    if ($post->post_type == 'package') {
        $single_template = plugin_dir_path( __FILE__ ) . 'template-paket/single-package.php';
    }
    return $single_template;
}

function get_custom_post_type_archive_template($archive_template) {
    global $post;

    if ($post->post_type == 'package') {
        $archive_template = plugin_dir_path( __FILE__ ) . 'template-paket/archive-package.php';
    }
    return $archive_template;
}

function get_custom_post_type_category_template($category_template) {
    global $post;

    if ($post->post_type == 'package') {
        $category_template = plugin_dir_path( __FILE__ )  . '/template-paket/category-project.php';
    }
    return $category_template;
}

add_filter( 'single_template', 'get_custom_post_type_single_template' );
add_filter( 'archive_template', 'get_custom_post_type_archive_template' );
add_filter( 'category_template', 'get_custom_post_type_category_template' );

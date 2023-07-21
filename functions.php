<?php

// Coonect styles
function wl_test_theme_scripts()
{

    wp_enqueue_style('wl-style.css', get_template_directory_uri() . '/assets/css/wl_style.css');
}
add_action('wp_enqueue_scripts', 'wl_test_theme_scripts');

// add custom post type
function create_car_post_type()
{
    $args = array(
        'public' => true,
        'show_in_rest' => true,
        'label'  => 'Car',
        'supports' => array('title', 'editor', 'thumbnail', 'author',),
        'taxonomies' => array('mark'),
        'has_archive' => true

    );
    register_post_type('car', $args);
}
add_action('init', 'create_car_post_type');

// add mark taxanomies into Car post type
function create_mark_taxonomy()
{
    $labels = array(
        'name'              => 'Marks',
        'singular_name'     => 'mark',
        'search_items'      => 'Search mark',
        'all_items'         => 'All marks',
        'edit_item'         => 'Edit marks',
        'update_item'       => 'Update mark',
        'add_new_item'      => 'Add new mark',
        'new_item_name'     => 'new mark name',
        'menu_name'         => 'Марка'
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'Марка')
    );

    register_taxonomy('mark', 'car', $args);
}
add_action('init', 'create_mark_taxonomy');

// add country taxanomies into Car post type
function create_country_taxonomy()
{
    $labels = array(
        'name'              => 'Countries',
        'singular_name'     => 'country',
        'search_items'      => 'Search country',
        'all_items'         => 'All countries',
        'edit_item'         => 'Edit countries',
        'update_item'       => 'Update country',
        'add_new_item'      => 'Add new country',
        'new_item_name'     => 'new country name',
        'menu_name'         => 'Страна производитель'
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'Страна производитель')
    );

    register_taxonomy('country', 'car', $args);
}
add_action('init', 'create_country_taxonomy');

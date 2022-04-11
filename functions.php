<?php

function my_theme_enqueue_styles()
{
    $parent_style = 'parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');


/*Adding Styles and Scripts*/
function theme_assets()
{
    wp_enqueue_script(
        'index-js',
        get_stylesheet_directory_uri() . '/assets/js/index.js',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/js/index.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'theme_assets');


/**Adding CPT */
function add_custom_post_type() {

    $labels = array(
        'name' => 'Events',
        'singular_name' => 'Event',
        'all_items' => 'All Events',
        'add_new' => 'Add Event'
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Events in San Cristóbal',
        'public'             => true,
        'publicly_queryable' => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'event' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'         => array('category'),
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-admin-site'
    );

    register_post_type('event', $args);
}

add_action("init", "add_custom_post_type");

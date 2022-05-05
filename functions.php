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

/**
 * Custom Post Type "Events"
 */

function cis_events_custom_post_type()
{
    $labels = [
        'name' => 'Events',
        'singular_name' => 'Event',
        'menu_name' => 'Events',
        'add_new' => "Add Event",
        'edit_item' => "Edit Event",
        'view_item' => "View Event",
    ];

    $args = [
        'label'         => 'Events',
        'description'   => 'Upcoming events of the Space Exploration Technologies Corporation (SpaceX)',
        'labels'        => $labels,
        'supports'      => ['title', 'editor', 'thumbnail', 'revisions'],
        'public'        => true,
        'show_in_menu'  => true,
        'show_ui'       => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-airplane',
        'can_export'    => true,
        'publicly_queryable' => true,
        'rewrite'       => ['slug' => 'event'],
        'has_archive'   => true,
        'hierarchical'  => false,
        'show_in_rest'  => true,
        'taxonomies'    => ['category'],
    ];

    register_post_type('event', $args);
}

add_action('init', 'cis_events_custom_post_type');

/**
 * REST API
 */

function get_all_events()
{
    $args = [
        'post_type'      => 'event',
        'posts_per_page' => -1,
        'order'     => 'ASC',
        'orderby'   => 'meta_value',
        'meta_key'  => 'event_date',
        'meta_type' => 'DATE'
    ];

    $events = new WP_Query($args);
    $data = [];

    if ($events->have_posts()) {
        while ($events->have_posts()) {
            $events->the_post();
            $data[] = [
                'event_name' => get_the_title(),
                'content' => get_the_content(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                'event_date' => get_field('event_date', get_the_ID())
            ];
        }
    }

    return $data;
}

add_action("rest_api_init", function () {
    register_rest_route("cis/v1", "events", [
        'methods' => 'GET',
        'callback' => 'get_all_events'
    ]);
});

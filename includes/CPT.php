<?php

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
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

function events_custom_post_type() {
    /*
     * The $labels describes how the post type appears.
     */
    $labels = array(
        'name'          => 'Events', // Plural name
        'singular_name' => 'Event',   // Singular name
        'all_items' => 'All Events' //Todos los eventos
    );

    /*
     * The $supports parameter describes what the post type supports
     */
    $supports = array(
        'title',        
        'editor',            
        'author',       
        'thumbnail',    

    );

    /*
     * The $args parameter holds important parameters for the custom post type
     */
    $args = array(
        'labels'              => $labels,
        'description'         => 'Football Events in the 2022 World Cup', // Description
        'supports'            => $supports,
        'taxonomies'          => array( 'category'), // Allowed taxonomies
        'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page
        'public'              => true,  // Makes the post type public
        'show_ui'             => true,  // Displays an interface for this post type
        'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel)
        'show_in_nav_menus'   => true,  // Displays in Appearance -> Menus
        'show_in_admin_bar'   => true,  // Displays in the black admin bar
        'menu_position'       => 5,     // The position number in the left menu
        'menu_icon'           => 'dashicons-tickets-alt',  // The URL for the icon used for this post type
        'can_export'          => true,  // Allows content export using Tools -> Export
        'has_archive'         => true,  // Enables post type archive (by month, date, or year)
        'exclude_from_search' => false, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false
        'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true
        'capability_type'     => 'post' // Allows read, edit, delete like “Post”
    );

    register_post_type('Event', $args); //Create a post type with the slug is ‘Event’ and arguments in $args.
}
add_action('init', 'events_custom_post_type');

add_action( 'rest_api_init', function () {
    register_rest_route( 'luiscarreno/v1', 'eventos', array(
      'methods' => 'GET',
      'callback' => 'events_rest_handler'
    ) );
  } );

  function events_rest_handler($parametros){

	//array use in the WP_QUERY
	$args = array(
		'post_type' => 'Event',
		'post_status' => 'publish',
		'posts_per_page' => -1,
	);
	$Events = new WP_Query( $args );

	//adding thumbnail and permalink for each event by luis carreno 
	$array_Events = array();

	foreach($Events->posts as $Event){
		array_push($array_Events,array('Image' => get_the_post_thumbnail_url($Event->ID),'content' => $Event->post_content,'title' => $Event->post_title, 'link' => get_permalink($Event->ID), 'date' => $Event->post_date));
	}

	return $array_Events;
}
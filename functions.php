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

//Create new custom post
function cpt_events() {
    register_post_type( 'events',
        array(
            'hierarchical'  => false, 
            'labels' => array(
                'name' => __( 'Events' ),
                'singular_name' => __( 'Events' ),
                'all_items' => __( 'All Events' ),
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'events'),
            'menu_position' => 4,
            'query_var' => true,
            'menu_icon'   => 'dashicons-clipboard',
            'supports' => array( 'title', 'editor', 'thumbnail'),
            'taxonomies'  => array( 'category', 'post_tag' )
        )
    );
}
add_action( 'init', 'cpt_events' );
//End custon 


// route new endpoint
add_action( 'rest_api_init', function () {
	register_rest_route( 'cis-test/v2', 'Events',
		array(
			'methods' => 'GET', 
			'callback' => 'AllEvents'
		)
	);
});

  function AllEvents(){
	$args = array (
		'post_type'     => 'Events',
    );
	// Run a custom query
	$query = new WP_Query($args);
	
    if($query->have_posts()) {
		//Define and empty array
		
        $i = 0;
		$data = array();
        
		// each post's data in the array
		while($query->have_posts()) {
			$query->the_post();            
			$data[$i]['title']          =   get_the_title();
            $data[$i]['content']        =   get_the_content();
			$data[$i]['thumbnail']      =   get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
            $data[$i]['date']           =   get_the_date();
            $data[$i]['author']         =   get_the_author();
            $data[$i]['type']           =   get_post_type();
			$data[$i]['link']           =   get_the_permalink();
			
			$i++;
		}
		// Return the data
		return $data;
	}
}
//End EnPoint

// allows the use of dashicons of wordpress
function ww_load_dashicons(){
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'ww_load_dashicons');
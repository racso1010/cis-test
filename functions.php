<?php


//******************************* Carga de estilos y scripts *******************************//


add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function my_theme_enqueue_styles(){
    $parent_style = 'parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'theme_assets');

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


//******************************* Creacion de nuevo CPT Eventos *******************************//


//activamos la funcion crear_tipo_publicacion_personalizada
add_action('init', 'crear_tipo_publicacion_personalizada');

function crear_tipo_publicacion_personalizada() {

	//configuracion de CPT eventos
	register_post_type( 'eventos',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => _('Eventos'),
				'singular_name' => __( 'Evento'),
				'all_items' => __('todos los eventos'),
			),
			'public' => true,
			'show_ui' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'eventos'),
			'menu_position' => 4,
			'query_var' => true,
			'menu_icon' => 'dashicons-buddicons-activity',
			'supports' => array('title', 'editor', 'thumbnail'),
			'taxonomies' => array('category', 'post_tag')
		)
	);
}


//******************************* Creacion de nuevo endpoint para el retorno de los datos cargados en el CPT eventos *******************************//

// Nuevo punto final
add_action( 'rest_api_init', function () {
	
	//registro de ruta y funcion callback
	register_rest_route( 'cistest/v1', 'eventos',array(
		'methods'  => 'GET',
		'callback' => 'get_latest_post'
	) );

});

//funcion para retornar todos los eventos creados
function get_latest_post ( $params ){

	//array de configuracion para atraves de WP_qury obtener los eventos
	$args = array(
		'post_type' => 'eventos',
		'post_status' => 'publish',
		'posts_per_page' => -1,
	);
	$posts = new WP_Query( $args );

	//funcion para la reorganizacion de la informacion en un array, ademas de la incorporacion del thumbnail al arreglo
	$array_thumbnail = array();

	foreach($posts->posts as $p){
		array_push($array_thumbnail,array('thumbnail' => get_the_post_thumbnail_url($p->ID),'post_content' => $p->post_content,'post_title' => $p->post_title, 'post_name' => $p->post_name));
	}

	return array($array_thumbnail);
}

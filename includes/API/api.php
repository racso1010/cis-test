<?php

// Router
function custom_router() {

    register_rest_route(
        "event",
        "get",
        array(
            "methods" => "GET",
            "callback" => 'get_events'
        )
    );
}

// controller
function get_events($request) {

    $posts = get_posts(array(
        'post_type' => 'event'
    ));

    foreach($posts as $post) {
        $post ->thumbnail = get_the_post_thumbnail_url($post ->ID);
        $post ->permalink = get_permalink($post ->ID);
    }

    return $posts;
}

add_action("rest_api_init", "custom_router");
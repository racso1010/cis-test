<?php

function get_all_events()
{
  $args = [
    'post_type'      => 'event',
    'posts_per_page' => -1,
    'order'     => 'DESC',
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
        'id'         => get_the_ID(),
        'name'       => get_the_title(),
        'content'    => get_the_content(),
        'permalink'  => get_the_permalink(),
        'image'      => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
        'date'       => get_field('event_date', get_the_ID())
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

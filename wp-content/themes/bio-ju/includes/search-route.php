<?php

add_action('rest_api_init', 'search');

function search(){
    register_rest_route('bio-ju/v1','search',array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'searchResults'
    ));
}

function searchResults($data){
    $produkte = new WP_Query(array(
        'post_type' => 'produkt',
        's' => sanitize_text_field($data['keyword'])
    ));

    $produkteResults = array();

    while ($produkte->have_posts()) {
        $produkte->the_post();

        array_push($produkteResults,array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'image' => get_the_post_thumbnail_url()
        ));
    }

    return $produkteResults;
}
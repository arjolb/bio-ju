<?php

function post_types(){
    
    // register_post_type('tipi i produktit',array(
        // 'supports' => array('title'),
        // 'public' => true,
        // 'labels' => array(
            // 'name' => 'Lloji i produktit',
            // 'add_new_item' => 'Shto llojin e produktit',
            // 'edit_item' => 'Ndrysho llojin produktit',
            // 'all_items' => 'Të gjitha llojet e produkteteve',
            // 'singular_name' => 'Lloji i produktit'
        // ),
        // 'menu_icon' => 'dashicons-tag',
        // 'capability_type' => 'tipi_i_produktit',
        // 'map_meta_cap' => true
    // ));
    // 
    // register_post_type('produkt',array(
        // 'supports' => array('title','thumbnail'),
        // 'public' => true,
        // 'labels' => array(
            // 'name' => 'Produkte',
            // 'add_new_item' => 'Shto produkt',
            // 'edit_item' => 'Ndrysho produktin',
            // 'all_items' => 'Të gjitha produktet',
            // 'singular_name' => 'Produkt'
        // ),
        // 'menu_icon' => 'dashicons-cart',
        // 'show_in_rest' => true,
        // 'capability_type' => 'tipi_i_produktit',
        // 'map_meta_cap' => true
    // ));


    register_post_type('receta',array(
        'supports' => array('title','editor','thumbnail','excerpt'),
        'public' => true,
        'labels' => array(
            'name' => 'Receta',
            'add_new_item' => 'Shto recete',
            'edit_item' => 'Ndrysho recete',
            'all_items' => 'Te gjitha recetat',
            'singular_name' => 'Recete'
        ),
        'menu_icon' => 'dashicons-media-document',
        'has_archive' => true
    ));

}

add_action('init', 'post_types');
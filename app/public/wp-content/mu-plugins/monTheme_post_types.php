<?php

function monTheme_post_types() {

    // enregistrement des incubateurs
    register_post_type('incubateur', array(
        'supports' => array(
            'title', 'editor', 'excerpt'
        ),
        'rewrite' => array(
            'slug' => 'incubateurs'
        ),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Incubateurs',
            'add_new_item' => 'Ajouter un nouvel incubateur',
            'edit_item' => 'Modifier un incubateur',
            'all_items' => 'Tous les incubateurs',
            'singular_name' => 'Incubateur'
        ),
        'menu_icon' => 'dashicons-location-alt'
    ));


    // enregistrement des évenements
    register_post_type('evenement', array(
        'supports' => array(
            'title', 'editor', 'excerpt'
        ),
        'rewrite' => array(
            'slug' => 'evenements'
        ),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Évènements',
            'add_new_item' => 'Ajouter un nouvel évènement',
            'edit_item' => 'Modifier un évènement',
            'all_items' => 'Tous les évènements',
            'singular_name' => 'Évènement'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));


    // enregistrement des programmes
    register_post_type('programme', array(
        'show_in_rest' => true,
        'supports' => array(
            'title'
        ),
        'rewrite' => array(
            'slug' => 'programmes'
        ),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Programmes',
            'add_new_item' => 'Ajouter un nouveau programme',
            'edit_item' => 'Modifier un programe',
            'all_items' => 'Tous les programmes',
            'singular_name' => 'Programme'
        ),
        'menu_icon' => 'dashicons-awards'
    ));

    // enregistrement des coaches
    register_post_type('coach', array(
        'show_in_rest' => true,
        'supports' => array(
            'title', 'editor', 'thumbnail'
        ),
        'rewrite' => array(
            'slug' => 'coaches'
        ),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Coaches',
            'add_new_item' => 'Ajouter un nouveau coach',
            'edit_item' => 'Modifier un coach',
            'all_items' => 'Tous les coaches',
            'singular_name' => 'Coach'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));

}

add_action('init', 'monTheme_post_types');
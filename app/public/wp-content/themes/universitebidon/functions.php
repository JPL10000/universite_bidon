<?php

function university_files() {
    wp_enqueue_script('main-universite_js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
    wp_enqueue_style('custom_google_fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('le_css_de_mon_universite', get_stylesheet_uri(), NULL, microtime());
}
add_action('wp_enqueue_scripts', 'university_files');


function university_features() {
    register_nav_menu('headerMenuLocation', 'Mon menu position entête');
    register_nav_menu('footerLocation1', 'Mon menu footer 1');
    register_nav_menu('footerLocation2', 'Mon menu footer 2');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'university_features');
<?php

function university_files() {
    wp_enqueue_style('le_css_de_mon_universite', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'university_files');
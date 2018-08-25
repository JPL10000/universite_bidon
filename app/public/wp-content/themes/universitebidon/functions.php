<?php

function monTheme_custom_rest() {
    register_rest_field('post', 'nomAuteur', array(
        'get_callback' => function() {return get_the_author();}
    ));
    register_rest_field('post', 'justeUnEssai', array(
        'get_callback' => function() {return get_the_ID()*2300;}
    ));
}

add_action('rest_api_init', 'monTheme_custom_rest');

function bannierePage($args = NULL) {
    
    if (!$args['titre']) {
        $args['titre'] = get_the_title();
    }
    if (!$args['sous-titre']) {
        $args['sous-titre'] = get_field('sous-titre_de_la_banniere');
    }
    if (!$args['photo']) {
        if (get_field('image_de_fond_banniere')) {
            $args['photo'] = get_field('image_de_fond_banniere')['sizes']['banniere'];
        }
        else {
            $args['photo'] = get_theme_file_uri('images/ocean.jpg');
        }
    }
?>
 <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>); "></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['titre']; ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['sous-titre']; ?></p>
      </div>
    </div>  
  </div>
<?php
}


function monTheme_files() {
    wp_enqueue_script('themePrincipal_js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
    wp_enqueue_style('custom_google_fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('le_css_de_mon_theme', get_stylesheet_uri(), NULL, microtime());
    wp_localize_script('themePrincipal_js', 'monThemeData', array(
            "root_url" => get_site_url()
    ));
}
add_action('wp_enqueue_scripts', 'monTheme_files');


function monTheme_features() {
    register_nav_menu('headerMenuLocation', 'Mon menu position entête');
    register_nav_menu('footerLocation1', 'Mon menu footer 1');
    register_nav_menu('footerLocation2', 'Mon menu footer 2');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('coachPaysage', 400, 260, true);
    add_image_size('coachPortrait', 480, 650, true);
    add_image_size('banniere', 1500, 350, true);
}
add_action('after_setup_theme', 'monTheme_features');

function monTheme_correction_requetes($query) {
    if (!is_admin() AND is_post_type_archive('incubateur') AND $query->is_main_query()) {
        $query->set('posts_per_page', -1);
    }


    if (!is_admin() AND is_post_type_archive('programme') AND $query->is_main_query()) {
        $query->set('order_by', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if (!is_admin() AND is_post_type_archive('evenement') AND $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'date_de_l_evenement'); 
        $query->set('order_by', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
              'key' => 'date_de_l_evenement',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            )
        )
        );
    }
}

add_action('pre_get_posts', 'monTheme_correction_requetes');


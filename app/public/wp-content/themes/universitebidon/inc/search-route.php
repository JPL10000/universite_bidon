<?php

function monThemeSearch() {
    register_rest_route('monTheme/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE, // on pourrait aussi utiliser GET mais ça ne marcherait pas à chaque fois
        'callback' => 'monThemeSearchResults'
    )); // namespace, route, options sous forme d'array
}

add_action('rest_api_init','monThemeSearch');

function monThemeSearchResults($data) {

    $mainQuery = new WP_Query(array(
        'post_type' => array(
            'post',
            'page',
            'coach',
            'programme',
            'evenement',
            'incubateur'
        ),
        'posts_per_page' => 20, // essayer avec -1
        's' => sanitize_text_field($data['recherche'])
    ));

    $results = array(
        'informationsGenerales' => array(), 
        'coaches' => array(),
        'programmes' => array(),
        'evenements' => array(),
        'incubateurs' => array()
    );

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if (get_post_type() == 'post' OR get_post_type() == 'page') {
            array_push($results['informationsGenerales'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'auteur' => get_the_author()
            )); // le tableau auquel on ajoute des datas, ce qu'on ajoute
        }

        if (get_post_type() == 'coach') {
            array_push($results['coaches'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'coachPaysage')
            )); 
        }

        if (get_post_type() == 'programme'){
            array_push($results['programmes'], array(
                'id'=> get_the_id(),
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            )); 
        }
        
        if (get_post_type() == 'evenement') {
            $dateEvenement = new DateTime(get_field('date_de_l_evenement'));
            $excerpt = null;
            if (has_excerpt()) {
                $excerpt = get_the_excerpt();
            } else {
                $excerpt = wp_trim_words(get_the_content(), 18);
            }

            array_push($results['evenements'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'mois' => $dateEvenement->format('M'),
                'jour' => $dateEvenement->format('d'),
                'excerpt' => $excerpt 
            )); 
        }
        
        if (get_post_type() == 'incubateur'){
            array_push($results['incubateurs'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            )); 
        }
    }

    if($results['programmes']) {
        $programmesMetaQuery = array('relation' => 'OR');
        foreach($results['programmes'] as $item) {
            array_push($programmesMetaQuery, array(
                'key' => 'programme_concerne',
                'compare' => 'LIKE',
                'value' => '"' . $item['id'] .'"'
            ));
        }
    
        $programmesRelationsQuery = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'coach',
            'order_by' => 'title',
            'order' => 'ASC',
            'meta_query' => $programmesMetaQuery
        ));
    
    
        while($programmesRelationsQuery->have_posts()) {
            $programmesRelationsQuery->the_post();
    
            if (get_post_type() == 'coach') {
                array_push($results['coaches'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'image' => get_the_post_thumbnail_url(0, 'coachPaysage')
                )); 
            }
            
        }
    
        $results['coaches'] = array_values(array_unique($results['coaches'], SORT_REGULAR));
    }


    return $results;

} 
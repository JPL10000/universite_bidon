<?php

// le thème pour les archives

get_header();
bannierePage(array(
  'titre' => 'Tous les évènements passés',
  'sous-titre' => 'Découvrez ce qui s\'est déjà passé autour de vous'
));
?>

<div class="container container--narrow page-section">

<?php

    $today = date('Ymd');
    $evenementsPasses = new WP_Query(array(
        'paged' => get_query_var('paged', 1), //réglage pour que la pagination fonctionne avec ce post-type personnalisé
        'post_type' => 'evenement',
        'meta_key' => 'date_de_l_evenement',
        'order_by' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
            'key' => 'date_de_l_evenement',
            'compare' => '<',
            'value' => $today,
            'type' => 'numeric'
            )
        )
    ));

    while($evenementsPasses->have_posts()) {
        $evenementsPasses->the_post();
        get_template_part('template-parts/content-event');
    }

    echo paginate_links(array(
        'total' => $evenementsPasses->max_num_pages
    ));

    ?>

</div>

<?php

get_footer();

?>
<?php

// le thème pour les archives

get_header();
bannierePage(array(
  'titre' => 'Tous les évènements',
  'sous-titre' => 'Découvrez ce qui se passe autour de vous'
))
?>

<div class="container container--narrow page-section">

<?php
    while(have_posts()) {
        the_post(); 
        get_template_part('template-parts/content-event');
    }

echo paginate_links();

    ?>

<hr class="section-break">

<p>A la recherche d'un événement passé ? <a href="<?php echo site_url('/evenements-passes') ?>">Consultez les archives !</a></p>

</div>

<?php

get_footer();

?>
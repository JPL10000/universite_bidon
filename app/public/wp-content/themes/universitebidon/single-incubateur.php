<?php

get_header();

while(have_posts()) {
    the_post(); 
    bannierePage();
    $nom_incubateur = get_the_title();
    $id_du_post = get_the_ID();
    ?>
    

<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('incubateur'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Tous les incubateurs</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div> 

    <div class="generic-content"><?php the_content(); ?></div>


    <?php

        the_post(); 

        if (get_field('numero_et_rue')) { $numero_et_rue = get_field('numero_et_rue').', '; };
        if (get_field('code_postal')) { $code_postal = get_field('code_postal').', '; };
        if (get_field('ville')) { $ville = get_field('ville').', '; };
        if (get_field('pays')) { $pays = get_field('pays'); };

        $adresse = $numero_et_rue.$code_postal.$ville.$pays;
        $numero_et_rue = $code_postal = $ville = $pays = "";
        
        $shortcode_map = "[leaflet-map height=600 address=\"".$adresse."\" zoom=13 zoomcontrol=1 scrollwheel=1]";
        echo do_shortcode($shortcode_map);

        $shortcode_marker = "[leaflet-marker address=\"".$adresse."\"]".$nom_incubateur."<br>".$adresse."[/leaflet-marker]";
        echo do_shortcode($shortcode_marker);


        $programmesConcernes = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'programme',
        'order_by' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'incubateur_concerne',
            'compare' => 'LIKE',
            'value' => '"' . $id_du_post .'"'
          )
        )
      ));

      if ($programmesConcernes->have_posts()) {
        
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Programmes dans cet incubateur</h2>';

        echo '<ul class="min-list link-list">';
        while($programmesConcernes->have_posts()) {
          $programmesConcernes->the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
              </a>
            </li>
        <?php  
        }
        echo '</ul>';
      }

      wp_reset_postdata();
    ?>
</div>
<?php
}

get_footer();

?>
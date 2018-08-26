<?php

get_header();

while(have_posts()) {
    the_post(); 
    bannierePage();
    ?>

<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('programme'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Tous les programmes</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div> 

    <div class="generic-content"><?php the_field('main_body_content'); ?></div>

    <?php 

        $coachesConcernes = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'coach',
        'order_by' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'programme_concerne',
            'compare' => 'LIKE',
            'value' => '"' . get_the_ID() .'"'
          )
        )
      ));

      if ($coachesConcernes->have_posts()) {
        
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Coaches sur le sujet</h2>';

        echo '<ul class="coach-cards">';
        while($coachesConcernes->have_posts()) {
          $coachesConcernes->the_post(); ?>
            <li class="coach-card__list-item">
              <a class="coach-card" href="<?php the_permalink(); ?>">
                <img class="coach-card__image" src="<?php the_post_thumbnail_url('coachPaysage'); ?>">
                <<span class="coach-card__name"><?php the_title(); ?></span>
              </a>
            </li>
        <?php  
        }
        echo '</ul>';
      }

      wp_reset_postdata();

      $today = date('Ymd');
      $evenements_FrontPage = new WP_Query(array(
        'posts_per_page' => 2,
        'post_type' => 'evenement',
        'meta_key' => 'date_de_l_evenement',
        'order_by' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'date_de_l_evenement',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
          ),
          array(
            'key' => 'programme_concerne',
            'compare' => 'LIKE',
            'value' => '"' . get_the_ID() .'"'
          )
        )
      ));

      if ($evenements_FrontPage->have_posts()) {
        
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Prochains événements sur ce thème</h2>';

        while($evenements_FrontPage->have_posts()) {
          $evenements_FrontPage->the_post();
          get_template_part('template-parts/content-event');
        }
      }

      wp_reset_postdata();
      $incubateurConcerne = get_field('incubateur_concerne');

      if ($incubateurConcerne) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Ce programme est proposé par ces incubateurs</h2>';

        echo '<ul class="min-list link-list">';
        foreach ($incubateurConcerne as $incubateur) {
          ?>
          <li><a href="<?php echo get_the_permalink($incubateur); ?>"><?php echo get_the_title($incubateur); ?></a></li>
          <?php
        }
        echo '</ul>';

      }


    ?>
</div>
<?php
}

get_footer();

?>
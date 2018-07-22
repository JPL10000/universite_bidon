<?php

get_header();

while(have_posts()) {
    the_post(); ?>

 <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg'); ?>); "></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>NE PAS OUBLIER DE REMPLACER CELA AVEC UN CHAMP PERSONNALISE</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">


    <?php 
      $leParent = wp_get_post_parent_id(get_the_ID());
      if ($leParent) {
        ?>
        <div class="metabox metabox--position-up metabox--with-home-link">       <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($leParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Revenir vers <?php echo get_the_title($leParent) ;?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
        </div>
        <?php
      }
    ?>

    <?php
      $testArray = get_pages(array(
        'child_of' => get_the_ID()
      ));
    
    if($leParent or $testArray) { ?>

      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($leParent); ?>"><?php echo get_the_title($leParent); ?></a></h2>
        <ul class="min-list">
          <?php
          if($leParent) {
            $trouveLesEnfants = $leParent;
          }
          else {
            $trouveLesEnfants = get_the_ID();
          }
          wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $trouveLesEnfants,
            'sort_column' => 'menu_order'
          ));
          ?>
        </ul>
      </div>

    <?php
    }
    ?>


    <div class="generic-content">
     <?php the_content(); ?>
    </div>

  </div>

    <?php 
}

get_footer();

?>
<?php

get_header();

while(have_posts()) {
    the_post();
    bannierePage();

    ?>

<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('evenement'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Revenir vers les évènements</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div> 

    <div class="generic-content"><?php the_content(); ?></div>

<?php 
  
    $programmesConcernes = get_field('programme_concerne');
    
    if($programmesConcernes) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Programme(s) concerné(s)</h2>';
      echo '<ul class="link-list min-list">';
      foreach ($programmesConcernes as $programme) { ?>
        <li><a href="<?php echo get_the_permalink($programme); ?>"><?php echo get_the_title($programme); ?></a></li>
      <?php }
      echo '</ul>';
    }

?>

</div>


<?php
}

get_footer();

?>
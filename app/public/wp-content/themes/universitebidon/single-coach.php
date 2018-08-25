<?php

get_header();

while(have_posts()) {
    the_post(); 
    bannierePage();
        
?>
    

<div class="container container--narrow page-section">

    <div class="generic-content">
      <div class="row group">
        <div class="one-third">
          <?php the_post_thumbnail('coachPortrait'); ?>
        </div>
        <div class="two-thirds">
          <?php the_content(); ?>
        </div>
      </div>
      
      
      <?php  ?></div>

<?php 
  
    $programmesConcernes = get_field('programme_concerne');
    
    if($programmesConcernes) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Domaines enseignés</h2>';
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
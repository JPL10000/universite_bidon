<?php

// le thème pour les archives

get_header();
$after = ""; if (strlen(get_the_archive_description()) > 50) $after = "...";
bannierePage(array(
    'titre' => get_the_archive_title(),
    'sous-titre' => substr(get_the_archive_description(), 0, 50).$after
));

?>


<div class="container container--narrow page-section">

<?php
    while(have_posts()) {
        the_post(); ?>
        <div class="post-item">
            <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="metabox">
                <p>Posté par <?php the_author_posts_link(); ?> le <?php the_time('j/m/Y'); ?> dans "<?php echo get_the_category_list(', '); ?>"</p>
            </div>
            <div class="generic_content">
                <?php the_excerpt(); ?>
                <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">La suite >></a></p>
            </div>
        </div>
    <?php
    }

echo paginate_links();

    ?>

</div>

<?php

get_footer();

?>
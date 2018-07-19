
<?php

while(have_posts()) {
    the_post(); ?>
    Nous sommes sur une page, pas sur un article.
    <h1>
    <?php the_title(); ?>
    </h1>
    <?php 
    the_content();
}

?>
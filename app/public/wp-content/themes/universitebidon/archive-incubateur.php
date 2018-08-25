<?php

// le thème pour les archives

get_header();
bannierePage(array(
  'titre' => 'Tous les incubateurs',
  'sous-titre' => 'Vous trouverez forcément l\'incubateur pour vous !'
));

?>

<div class="container container--narrow page-section">

    <?php

        $shortcode_map = "[leaflet-map height=600 lat=47 lng=3 zoom=6 zoomcontrol=1 scrollwheel=1]";
        echo do_shortcode($shortcode_map);


        while(have_posts()) {
            the_post(); 
            if (get_field('numero_et_rue')) { $numero_et_rue = get_field('numero_et_rue').', '; };
            if (get_field('code_postal')) { $code_postal = get_field('code_postal').', '; };
            if (get_field('ville')) { $ville = get_field('ville').', '; };
            if (get_field('pays')) { $pays = get_field('pays'); };

            $adresse = $numero_et_rue.$code_postal.$ville.$pays;
            $numero_et_rue = $code_postal = $ville = $pays = "";

            $shortcode_marker = "[leaflet-marker address=\"".$adresse."\"]<a href=\"".get_the_permalink()."\">".get_the_title()."</a><br>".$adresse."[/leaflet-marker]";
            echo do_shortcode($shortcode_marker);
        }
    ?>

</div>

<?php

get_footer();

?>
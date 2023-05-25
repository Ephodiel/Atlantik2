<h2><?php echo $TitreDeLaPage ?></h2>

<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesProduits : variable récupérée depuis le contrôleur (en 'mode tableau associatif')
 -->


<?php foreach ($lesSecteurs as $unSecteur) :
    echo '<h3>'.anchor('voirliaisonssecteurs/'. $unSecteur["NOSECTEUR"], $unSecteur["NOM"]).'</h3>';
endforeach ?>

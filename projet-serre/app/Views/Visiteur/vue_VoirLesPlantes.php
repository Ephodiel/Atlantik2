<h2><?php echo $TitreDeLaPage ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesProduits : variable récupérée depuis le contrôleur (en 'mode tableau associatif')
 -->
<?php foreach ($lesplantes as $uneplante) :
    echo '<h3>'.anchor('voirlesplantes/'.$uneplante["noplante"], $uneplante["nomplante"]).'</h3>';
endforeach ?>
<p>Pour afficher le détail d'un plante, cliquer sur son nom</p>
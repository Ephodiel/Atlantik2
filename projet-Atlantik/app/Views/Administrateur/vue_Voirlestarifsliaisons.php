<h2><?php echo $TitreDeLaPage ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesCommandes : les commandes avec leurs produits
 -->
<?php

//mettre les no liaison et d'ou a ou


?>
<table class='table table-striped'>
<?php
echo '
<tr>
    <th>Catégorie</th>
    <th>Type</th>
    <th>Période</th>

</tr>';

foreach ($lesLiaisons->getresult() as $uneLiaison) :
{
    echo "<tr>
    <td>$uneLiaison->nom</td>
    <td>".anchor('voirlestarifsliaisons/'.$uneLiaison->noliaison, $uneLiaison->noliaison)."</td>
    <td>$uneLiaison->distance</td>
    <td>$uneLiaison->depart</td>
    <td>$uneLiaison->arrivee</td>
    </tr>";
}
    endforeach?>
</table> 

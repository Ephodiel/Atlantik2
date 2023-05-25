<h2><?php echo $TitreDeLaPage ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesCommandes : les commandes avec leurs produits
 -->

<table class='table table-striped'>
<?php
echo '
<tr>
    <th>Secteur</th>
    <th>Liaison</th>
    <th>Liaison</th>
    <th>Liaison</th>
    <th>Liaison</th>
</tr>';

echo"<tr>
    <th></th>
    <th>Code Liaison</th>
    <th>Distance en milles marin</th>
    <th>Port de départ</th>
    <th>Port d'arrivée</th>
</tr>";
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

 
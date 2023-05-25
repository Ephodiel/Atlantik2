<?php
echo '<h2>'.$TitreDeLaPage.'</h2>';
echo '<img src="'.img_url($unProduit['image']).'" />'; //retourne l'url de l'image (cf. assets)
// OU, sans utiliser le helper assets :
// echo '<img src="'.base_url().'/assets/images/'.$unProduit['image'].'"/>';
echo '<table>';
echo '<tr><td>Référence</td><td>'.$unProduit['reference'].'</td></tr>';
echo '<tr><td>Libellé</td><td>'.$unProduit['libelle'].'</td></tr>';
echo '<tr><td>Prix HT</td><td>'.$unProduit['prixht'].'</td></tr>';
echo '<tr><td>Quantité en stock</td><td>'.$unProduit['quantiteenstock'].'</td></tr>';
echo '</table>';
echo '<p>'.anchor('voirlesproduits','Retour à la liste de tous les Produits').'</p>';
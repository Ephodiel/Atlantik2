<h2><?php echo $TitreDeLaPage ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesProduits : variable récupérée depuis le contrôleur (en 'mode tableau associatif')
 -->
<?php foreach ($lesProduits as $unProduit) :
    echo '<h3>'.anchor('voirlesproduits/'.$unProduit["reference"], $unProduit["libelle"]).'</h3>';
endforeach ?>
<p>Pour afficher le détail d'un produit, cliquer sur son libellé</p>
 
<?= $pager->links() ?>
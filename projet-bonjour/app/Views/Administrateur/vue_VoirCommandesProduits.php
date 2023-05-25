<h2><?php echo $TitreDeLaPage ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesCommandes : les commandes avec leurs produits
 -->
<?php
$attributsTableau = ["table_open" => "<table class='table table-striped'>",]; // classe Bootstrap
$table = new \CodeIgniter\View\Table($attributsTableau);
$table->setHeading(['n° Commande', 'n° Client', 'Date', 'Réf. Produit',
'Quantité commandée', 'Libellé', 'Prix HT']); // entête tableau
echo $table->generate($lesCommandes);
 
/* avec retour ModeleCommande::getAllCommandesProduits() = $builder->get()->getResult();
les 4 instructions précédentes sont équivalentes a celles qui suivent
 
echo "<table class='table table-striped'>";
echo "
<tr>
<th>n° Commande</th>
<th>n° Client</th>
<th>Date</th>
<th>Réf. Produit</th>
<th>Quantité commandée</th>
<th>Libellé</th>
<th>Prix HT</th>
</tr>";
foreach ($lesCommandes as $uneCommande)
{
    echo "<TR>";
    echo "<TD>".$uneCommande->numero."</TD><TD>"
    .$uneCommande->numeroclient."</TD><TD>"
    .$uneCommande->datecommande."</TD><TD>"
    .$uneCommande->referenceproduit."</TD><TD>"
    .$uneCommande->quantitecommandee."</TD><TD>"
    .$uneCommande->libelle."</TD><TD>"
    .$uneCommande->prixht."</TD>";
    echo "</TR>";
}
echo "</table>";
*/
?>
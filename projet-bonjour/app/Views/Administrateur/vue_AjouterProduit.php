<h2><?php echo $TitreDeLaPage ?></h2>
<?php
if ($TitreDeLaPage == 'Saisie produit incorrecte')
  echo service('validation')->listErrors(); // affichage liste des erreurs, suite à erreur validation
 
echo form_open('ajouterproduit') // ajouterproduit = entrée route vers Administrateur:ajouterProduit (!!)
?>
 
<?php echo csrf_field(); ?>
 
<label for="txtReference">Référence du produit (3 caractères)</label>
<input type="input" name="txtReference" value="<?php echo set_value('txtReference'); ?>" /><br />
 
<label for="txtLibelle">Libellé du produit</label>
<input type="input" name="txtLibelle" value="<?php echo set_value('txtLibelle'); ?>" /><br />
 
<label for="txtPrixHT">Prix HT du produit</label>
<input type="input" name="txtPrixHT" value="<?php echo set_value('txtPrixHT'); ?>" /><br />
 
<label for="txtQuantiteEnStock">Quantité en stock du produit</label>
<input type="input" name="txtQuantiteEnStock" value="<?php echo set_value('txtQuantiteEnStock'); ?>" /><br />
 
<label for="txtNomFichierImage">Nom du fichier image du produit</label>
<input type="input" name="txtNomFichierImage" value="<?php echo set_value('txtNomFichierImage'); ?>" /><br />
 
<input type="submit" name="submit" value="Ajouter un produit" />
<?php echo form_close(); ?>
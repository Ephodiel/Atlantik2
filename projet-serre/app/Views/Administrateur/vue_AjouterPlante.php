<h2><?php echo $TitreDeLaPage ?></h2>
<?php
if ($TitreDeLaPage == 'Saisie plante incorrecte')
  echo service('validation')->listErrors(); // affichage liste des erreurs, suite à erreur validation
 
echo form_open('ajouterplante') // ajouterproduit = entrée route vers Administrateur:ajouterProduit (!!)
?>
 
<?php echo csrf_field(); ?>
 
<label for="txtnoplante">numéro de la plante (4 caractères)</label>
<input type="input" name="txtnoplante" value="<?php echo set_value('txtnoplante'); ?>" /><br />
 
<label for="txtnomplante">nom de la plante</label>
<input type="input" name="txtnomplante" value="<?php echo set_value('txtnomplante'); ?>" /><br />
 
<label for="txtnoregion">numéro de region de la plante</label>
<input type="input" name="txtnoregion" value="<?php echo set_value('txtnoregion'); ?>" /><br />

 
<input type="submit" name="submit" value="Ajouter une plante" />
<?php echo form_close(); ?>
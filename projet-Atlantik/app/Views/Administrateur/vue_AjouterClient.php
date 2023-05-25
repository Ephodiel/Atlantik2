<h2><?php echo $TitreDeLaPage ?></h2>
<?php
if ($TitreDeLaPage == 'Saisie produit incorrecte')
  echo service('validation')->listErrors(); // affichage liste des erreurs, suite à erreur validation
 
echo form_open('ajouterclient') // ajouterproduit = entrée route vers Administrateur:ajouterProduit (!!)
?>
 
<?php echo csrf_field(); ?>
 
<label for="txtNom">Nom</label>
<input type="input" name="txtNom" value="<?php echo set_value('txtNom'); ?>" /><br />
 
<label for="txtPrenom">Prenom</label>
<input type="input" name="txtPrenom" value="<?php echo set_value('txtPrenom'); ?>" /><br />
 
<label for="txtAdresse">Adresse</label>
<input type="input" name="txtAdresse" value="<?php echo set_value('txtAdresse'); ?>" /><br />

<label for="txtCodePostal">Code postal</label>
<input type="input" name="txtCodePostal" value="<?php echo set_value('txtCodePostal'); ?>" /><br />
 
<label for="txtVille">Ville</label>
<input type="input" name="txtVille" value="<?php echo set_value('txtVille'); ?>" /><br />
 
<label for="txtMel">Mel</label>
<input type="input" name="txtMel" value="<?php echo set_value('txtMel'); ?>" /><br />

<label for="txtTelFixe">Telephone Fixe</label>
<input type="input" name="txtTelFixe" value="<?php echo set_value('txtTelFixe'); ?>" /><br />

<label for="txtTelMob">Telephone Mobile</label>
<input type="input" name="txtTelMob" value="<?php echo set_value('txtTelMob'); ?>" /><br />

<label for="txtMdp">Mdp</label>
<input type="input" name="txtMdp" value="<?php echo set_value('txtMdp'); ?>" /><br />

<input type="submit" name="submit" value="Ajouter un Client" />
<?php echo form_close(); ?>
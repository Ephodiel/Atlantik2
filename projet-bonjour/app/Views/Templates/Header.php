<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>eRabelais</title>
</head>
<body>
<div class="p-2 bg-primary text-white text-center">
  <h1>eRabelais
  </h1>
</div>
    <?php
        $session = session();
        if(!is_null($session->get('identifiant'))) : ?>
        <?php echo 'Utilisateur connecté : ' . $session->get('identifiant').'&nbsp;&nbsp;'; ?>
        <a href="<?php echo site_url('sedeconnecter') ?>">Se déconnecter</a>&nbsp;&nbsp;
        <?php if ($session->get('profil') == 'SuperAdministrateur') : ?>
            <a href="<?php echo site_url('ajouterproduit') ?>">Ajouter un produit</a>&nbsp;&nbsp;
            <a href="<?php echo site_url('voircommandesproduits') ?>">Voir commandes-produits</a>&nbsp;&nbsp;
            <?php endif;  ?>
    <?php else : ?>
        <a href="<?php echo site_url('seconnecter') ?>">Se Connecter</a>&nbsp;&nbsp;
    <?php endif; ?>
    <a href="<?php echo site_url('voirlesproduits') ?>">Voir tous les produits</a>&nbsp;&nbsp;
    <a href="<?php echo site_url('voirlesproduitsavecpagination') ?>">Lister les produits (par 3)</a>&nbsp;&nbsp;
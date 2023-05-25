<?php
namespace App\Controllers;

use App\Models\ModeleProduit;
use App\Models\ModeleCommande;
helper(['url', 'assets', 'form']);

class Administrateur extends BaseController
{
    public function ajouterProduit()
    {
        $data['TitreDeLaPage'] = 'Ajouter un Produit';
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) {
            /* le formulaire n'a pas été posté, on retourne le formulaire */
            return view('Templates/Header')
            . view('Administrateur/vue_AjouterProduit', $data)
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* VALIDATION DU FORMULAIRE */
        $reglesValidation = [
            'txtReference' => 'required|alpha_numeric|exact_length[3]',
            // obligatoire, 3 caractères, exactement
            'txtLibelle' => 'required|string|max_length[30]',
            // obligatoire, chaîne de carac. <= 30 carac.
            'txtPrixHT' => 'permit_empty|numeric',
            // vide ou numérique
            'txtQuantiteEnStock' => 'permit_empty|integer',
            // vide ou integer
            'txtNomFichierImage' => 'permit_empty|string|max_length[20]',
            // vide ou chaîne <= 20 carac.
        ];
        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé, on renvoie le formulaire */
            $data['TitreDeLaPage'] = "Saisie produit incorrecte";
            return view('Templates/Header')
            . view('Administrateur/vue_AjouterProduit', $data)
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* INSERTION PRODUIT SAISI DANS BDD */
        $donneesAInserer = array(
            'reference' => $this->request->getPost('txtReference'),
            'libelle' => $this->request->getPost('txtLibelle'),
            'prixht' => $this->request->getPost('txtPrixHT'),
            'quantiteenstock' => $this->request->getPost('txtQuantiteEnStock'),
            'image' => $this->request->getPost('txtNomFichierImage'),
        ); // reference, libelle, prixht, quantiteenstock, image : champs de la table 'produit'
        $modelProduit = new ModeleProduit(); //instanciation du modèle
        $donnees['nbDeLignesAffectees'] = $modelProduit->insert($donneesAInserer);
        // save, provoque insert sur la table mappée (produit, ici)
        return view('Templates/Header')
            .view('Administrateur/vue_RapportAjouterProduit', $donnees)
            .view('Templates/Footer');
    } // ajouterProduit

    public function voirCommandesProduits()

  {
    $modeleCommande = new ModeleCommande(); //instanciation du modèle
    $donnees['lesCommandes'] = $modeleCommande->getAllCommandesProduits();
    $donnees['TitreDeLaPage'] = "Liste des commandes avec leurs produits";
    return view('Templates/Header')
    . view('Administrateur/vue_VoirCommandesProduits', $donnees)
    . view('Templates/Footer');
  }
}
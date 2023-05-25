<?php
namespace App\Controllers;
use App\Models\ModelePlante;
 
helper(['url', 'assets', 'form']);
 
class Administrateur extends BaseController
{
    public function ajouterPlante()
    {
        $data['TitreDeLaPage'] = 'Ajouter une Plante';
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) {
            /* le formulaire n'a pas été posté, on retourne le formulaire */
            return view('Templates/Header')
            . view('Administrateur/vue_AjouterPlante', $data)
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* VALIDATION DU FORMULAIRE */
        $reglesValidation = [
            'txnoplante' => 'required|alpha_numeric|exact_length[4]',
            // obligatoire, 3 caractères, exactement
            'txtnomplante' => 'required|string|max_length[30]',
            // obligatoire, chaîne de carac. <= 30 carac.
            'txtnoregion' => 'permit_empty|integer',

        ];
        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé, on renvoie le formulaire */
            $data['TitreDeLaPage'] = "Saisie plante incorrecte";
            return view('Templates/Header')
            . view('Administrateur/vue_AjouterPlante', $data)
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* INSERTION PRODUIT SAISI DANS BDD */
        $donneesAInserer = array(
            'noplante' => $this->request->getPost('txnoplante'),
            'nomplante' => $this->request->getPost('txtnomplante'),
            'noregion' => $this->request->getPost('txtnoregion'),
    
        ); // reference, libelle, prixht, quantiteenstock, image : champs de la table 'produit'
        $modelPlante = newModelePlante(); //instanciation du modèle
        $donnees['nbDeLignesAffectees'] = $modelPlante->insert($donneesAInserer);
        // save, provoque insert sur la table mappée (produit, ici)
        return view('Templates/Header')
            .view('Administrateur/vue_RapportAjouterPlante', $donnees)
            .view('Templates/Footer');
    } // ajouterProduit
}
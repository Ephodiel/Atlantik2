<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison; 


helper(['url', 'assets', 'form']);
 
class Administrateur extends BaseController
{
    public function ajouterClient()
    {
        $data['TitreDeLaPage'] = 'Ajouter un Client';
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) {
            /* le formulaire n'a pas été posté, on retourne le formulaire */
            return view('Templates/Header')
            . view('Administrateur/vue_AjouterClient', $data)
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* VALIDATION DU FORMULAIRE */
        $reglesValidation = [
            'txtNom' => 'required|string|',
            'txtPrenom' => 'required|string|',
            'txtAdresse' => 'required|string',
            'txtCodePostal' => 'required|integer',
            'txtVille' => 'required|string|',
            'txtMel' => 'required|string|',
            'txtTelFixe' => 'required|integer|',
            'txtTelMob' => 'required|integer|',
            'txtMdp' => 'required|',

        ];
        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé, on renvoie le formulaire */
            $data['TitreDeLaPage'] = "Saisie client incorrecte";
            return view('Templates/Header')
            . view('Administrateur/vue_AjouterClient', $data)
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* INSERTION PRODUIT SAISI DANS BDD */
        $donneesAInserer = array(
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'codepostal' => $this->request->getPost('txtCodePostal'),
            'ville' => $this->request->getPost('txtVille'),
            'mel' => $this->request->getPost('txtMel'),
            'telephonefixe' => $this->request->getPost('txtTelFixe'),
            'telephonemobile' => $this->request->getPost('txtTelMob'),
            'motdepasse' => $this->request->getPost('txtMdp'),
        ); // reference, libelle, prixht, quantiteenstock, image : champs de la table 'produit'
        $modelClient = new ModeleClient(); //instanciation du modèle
        $donnees['nbDeLignesAffectees'] = $modelClient->insert($donneesAInserer);
        // save, provoque insert sur la table mappée (produit, ici)
        return view('Templates/Header')
            .view('Administrateur/vue_RapportAjouterClient', $donnees)
            .view('Templates/Footer');
    } // ajouterProduit

     
  public function voirLiaisons()
  {
    $modeleLiaisons = new ModeleLiaison(); //instanciation du modèle
    $donnees['lesLiaisons'] = $modeleLiaisons->getAllLiaisons();
    $donnees['TitreDeLaPage'] = "Liste des liaisons par secteurs";
    return view('Templates/Header')
    . view('Administrateur/vue_VoirLiaisonsSecteurs', $donnees)
    . view('Templates/Footer');
  }

}
 
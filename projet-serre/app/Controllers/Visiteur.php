<?php
namespace App\Controllers;
use App\Models\ModelePlante; //donne accès à la classe ModeleProduit
helper(['assets']); // donne accès aux fonctions du helper 'asset'
 
class Visiteur extends BaseController
{
    public function voirLesplantes($numeroPlante = null)
    {
        /* valeur par défaut de referenceProduit = NULL */
        $modPlante = new ModelePlante(); // instanciation du modèle
        if ($numeroPlante === null)
        /* pas de reference produit, = NULL -> Tous les produits */ {
            $data['lesplantes'] = $modPlante->getPlantes();
            /* ci-dessus : récup. des données, de tous les produits, via le modèle,
            et  affectation à l'entrée 'lesProduits' du tableau $data */
            $data['TitreDeLaPage'] = 'Toutes les plantes';
           
            return view('Templates/Header')
            . view('Visiteur/vue_VoirLesPlantes', $data)
            . view('Templates/Footer');
 
        } else /* une référence produit en entrée,
        ci-dessous n'affichera que le produit correspondant */
        
        
        {
            $data['unePlante'] = $modPlante->getPlantes($numeroPlante);
            /* ci-dessus : récup. des données du produit $referenceProduit via le modèle,
            et affectation à l'entrée 'unProduit' du tableau $data */
 
            if (empty($data['unePlante'])) { // pas de plante correspondant à la référence
                throw\CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                // génération d'une exception
            }
            $data['TitreDeLaPage'] = $data['unePlante']['nomplante'];
        

            return view('Templates/Header')
            . view('Templates/Footer');
       
            
        }
    }

        public function seConnecter()
        {
        helper(['form']);
        $session = session();
 
        $data['TitreDeLaPage'] = 'Se connecter';
 
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) {
            return view('Templates/Header', $data) // Renvoi formulaire de connexion
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */
 
        /* VALIDATION DU FORMULAIRE */
        $reglesValidation = [ // Régles de validation
            'txtIdentifiant' => 'required',
            'txtMotDePasse' => 'required',
        ];
        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé */
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_SeConnecter') // Renvoi formulaire de connexion
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* RECHERCHE UTILISATEUR DANS BDD */
        $Identifiant = $this->request->getPost('txtIdentifiant');
        $MdP = $this->request->getPost('txtMotDePasse');
 
        /* on va chercher dans la BDD l'utilisateur correspondant aux id et mot de passe saisis */
        $modUtilisateur = new ModeleUtilisateur(); // instanciation modèle
        $utilisateurRetourne = $modUtilisateur->retournerUtilisateur($Identifiant, $MdP);

        if ($utilisateurRetourne != null) {
            /* identifiant et mot de passe OK : identifiant et profil sont stockés en session */
            $session->set('identifiant', $utilisateurRetourne["identifiant"]);
            $session->set('profil', $utilisateurRetourne["profil"]);
            // profil = "SuperAdministrateur ou "Administrateur"
            $data['Identifiant'] = $Identifiant;
            echo view('Templates/Header', $data);
            echo view('Visiteur/vue_ConnexionReussie');
        } else {
            /* identifiant et/ou mot de passe OK : on renvoie le formulaire  */
            $data['TitreDeLaPage'] = "Identifiant ou/et Mot de passe inconnu(s)";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');
        }
    } // Fin seConnecter


    public function seDeconnecter()
    {
        session()->destroy();
        returnredirect()->to('seconnecter');
    } // Fin seDeconnecter

}


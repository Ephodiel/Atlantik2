<?php
namespace App\Controllers;
use App\Models\ModeleProduit; //donne accès à la classe ModeleProduit
use App\Models\ModeleUtilisateur;
helper(['assets']); // donne accès aux fonctions du helper 'asset'
 
class Visiteur extends BaseController
{
    public function voirLesProduits($referenceProduit = null)
    {
        /* valeur par défaut de referenceProduit = NULL */
        $modProduit = new ModeleProduit(); // instanciation du modèle
        if ($referenceProduit === null)
        /* pas de reference produit, = NULL -> Tous les produits */ {
            $data['lesProduits'] = $modProduit->getProduits();
            /* ci-dessus : récup. des données, de tous les produits, via le modèle,
            et  affectation à l'entrée 'lesProduits' du tableau $data */
            $data['TitreDeLaPage'] = 'Tous les produits';
           
            return view('Templates/Header')
            . view('Visiteur/vue_VoirLesProduits', $data)
            . view('Templates/Footer');
 
        } else /* une référence produit en entrée,
        ci-dessous n'affichera que le produit correspondant */
        {
            $data['unProduit'] = $modProduit->getProduits($referenceProduit);
            /* ci-dessus : récup. des données du produit $referenceProduit via le modèle,
            et affectation à l'entrée 'unProduit' du tableau $data */
 
            if (empty($data['unProduit'])) { // pas de produit correspondant à la référence
                throw\CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                // génération d'une exception
            }
            $data['TitreDeLaPage'] = $data['unProduit']['libelle'];
           
            return view('Templates/Header')
            . view('Visiteur/vue_VoirDetailUnProduit', $data)
            . view('Templates/Footer');
        }
    }

    
    public function voirLesProduitsAvecPagination()
    {
        $data['TitreDeLaPage'] = 'Tous les produits';
 
        $pager = \Config\Services::pager();
        $modelProd = new ModeleProduit(); //instanciation du modèle
        $data['lesProduits'] = $modelProd->paginate(3); // Récupération des données via le modèle
        $data['pager'] = $modelProd->pager;
     
        return view('Templates/Header') //envoi du header
        .view('Visiteur/vue_VoirLesProduitsAvecPagination', $data)
        .view('Templates/Footer'); //envoi du footer
    } // fin listerLesProduitsAvecPagination


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
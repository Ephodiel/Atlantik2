<?php
namespace App\Controllers;
use App\Models\ModeleSecteur;
use App\Models\ModeleClient;
use App\Models\ModeleUtilisateur;
helper(['assets']); // donne accès aux fonctions du helper 'asset'

class Visiteur extends BaseController
{
    public function seConnecter() 
    {
        helper(['form']);
        $session = session();

        $data['TitreDeLaPage'] = 'Se connecter';

        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) 
        {
            return view('Templates/Header', $data) // Renvoi formulaire de connexion
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */

        /* VALIDATION DU FORMULAIRE */
        $reglesValidation = [ // Régles de validation
        'txtMel' => 'required',
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
        $Mel = $this->request->getPost('txtMel');
        $MdP = $this->request->getPost('txtMotDePasse');

        /* on va chercher dans la BDD l'utilisateur correspondant aux id et mot de passe saisis */
        $modUtilisateur = new ModeleUtilisateur(); // instanciation modèle
        $condition = ['MEL'=>$Mel,'MOTDEPASSE'=>$MdP];
        $utilisateurRetourne = $modUtilisateur->where($condition)->first();
        /* where : méthode, QueryBuilder, héritée de Model (), retourne,
        ici sous forme d'un objet, le résultat de la requête :
        SELECT * FROM utilisateur  WHERE identifiant='$pId' and motdepasse='$MotdePasse
        utilisateurRetourne = objet utilisateur ($returnType = 'object')
        */

        if ($utilisateurRetourne != null) 
        {
            /* identifiant et mot de passe OK : identifiant et profil sont stockés en session */
            $session->set('MEL', $utilisateurRetourne->MEL);
            // profil = "SuperAdministrateur ou "Administrateur"
            $data['Mel'] = $Mel;
            echo view('Templates/Header', $data);
            echo view('Visiteur/vue_ConnexionReussie');
            }
        else 
        {
            /* identifiant et/ou mot de passe OK : on renvoie le formulaire  */
            $data['TitreDeLaPage'] = "Mel ou/et Mot de passe inconnu(s)";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');
        }
    }


    public function seDeconnecter()
    {
        session()->destroy();
        return redirect()->to('seconnecter');
    } // Fin seDeconnecter


    public function voirLesSecteurs($numeroSecteur = null)
    {
        /* valeur par défaut de referenceProduit = NULL */
        $modSecteur = new ModeleSecteur(); // instanciation du modèle
        if ($numeroSecteur === null)
            /* pas de reference produit, = NULL -> Tous les produits */ {
            $data['lesSecteurs'] = $modSecteur->getSecteurs();
            // findAll : héritée de Model, retourne, ici sous forme d'objets,
            // le résultat de la requête SELECT * FROM produit
            // affectation des objets produits retournés à l'entrée 'lesProduits' du tableau $data
            $data['TitreDeLaPage'] = 'Tous les secteurs';
 
 
            return view('Templates/Header')
            . view('Visiteur/vue_VoirLesReservations', $data)
            . view('Templates/Footer');
 
        } else
        // une référence produit en entrée : on n'affichera le détail du produit correspondant


        {
            $data['unSecteur'] = $modSecteur->getSecteurs($numeroSecteur);
            // find : : héritée de Model, retourne, ici sous forme d'un objet,
            // le résultat de la requête 'SELECT * FROM produit WHERE reference = '.$referenceProduit
            // l'objet produit est affectée à l'entrée 'unProduit' du tableau $data
 
            if (empty($data['unSecteur'])) { // pas de produit correspondant à la référence
                throw\CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                // génération d'une exception
            }
            $data['TitreDeLaPage'] = $data['unSecteur']['nom'];
 
            return view('Templates/Header')
            . view('Visiteur/vue_VoirDetailUneReservations', $data)
            . view('Templates/Footer');
        }

        



    } // Fin voirLesProduits



}
<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleSecteur extends Model
{
    protected $table = 'secteur';
    /* ci-dessus on indique la table a 'mapper' */
    protected $primaryKey = 'nosecteur'; // clé primaire
    protected $allowedFields = ['nosecteur', 'nom'];

     public function getSecteurs($numeroSecteur = false)
    {
        if ($numeroSecteur === false) // pas de référence produit  en paramètre :
        {   // on retourne tous les produits
            return $this->findAll(); // SELECT * FROM produit    
        }
        // $referenceProduit != NULL : on retourne le produit correspondant (en mode objet)
        return $this->where(['nosecteur' => $numeroSecteur])->first();
        // équivalent a 'SELECT * FROM produit WHERE reference = '.$referenceProduit
    }


    /* champs pour lesquels insertion, et mises à jour sont autorisées
    Nota Bene : on n'autorisera pas les champs en AUTOINCREMENT */
 
// Nota Bene : ModeleProduit héritent de très nombreuses méthodes : find, findAll, insert, update...
// Pour la liste complète : https://codeigniter.com/user_guide/models/model.html
 
}
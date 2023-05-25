<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleProduit extends Model
{
    protected $table = 'produit';
    protected $primaryKey = 'reference';
    /* ci-dessus on indique la table a 'mapper' */
    protected $allowedFields = ['reference', 'libelle', 'prixht', 'quantiteenstock', 'image'];
    /* champs pour lesquels insertion, et mises à jour sont autorisées
    Nota Bene : on n'autorisera pas les champs en AUTOINCREMENT */
 
    public function getProduits($referenceProduit = false)
    {
        if ($referenceProduit === false) // pas de référence produit  en paramètre :
        {   // on retourne tous les produits
            return $this->findAll(); // SELECT * FROM produit    
        }
        // $referenceProduit != NULL : on retourne le produit correspondant (en mode objet)
        return $this->where(['reference' => $referenceProduit])->first();
        // équivalent a 'SELECT * FROM produit WHERE reference = '.$referenceProduit
    }
}
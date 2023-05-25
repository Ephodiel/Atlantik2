<?php
namespace App\Models;

use CodeIgniter\Model;
 
class ModelePlante extends Model
{
    protected $table = 'plante';
    protected $primaryKey = 'noplante';
    /* ci-dessus on indique la table a 'mapper' */
    protected $allowedFields = ['noplante', 'nomplante', 'noregion'];
    /* champs pour lesquels insertion, et mises à jour sont autorisées
    Nota Bene : on n'autorisera pas les champs en AUTOINCREMENT */
 
    public function getPlantes($numeroPlante = false)
    {
        if ($numeroPlante === false) // pas de référence produit  en paramètre :
        {   // on retourne tous les produits
            return $this->findAll(); // SELECT * FROM produit    
        }
        // $referenceProduit != NULL : on retourne le produit correspondant (en mode objet)
        return $this->where(['noplante' => $numeroPlante])->first();
        // équivalent a 'SELECT * FROM plante WHERE noplante = '.$referenceProduit
    }
}
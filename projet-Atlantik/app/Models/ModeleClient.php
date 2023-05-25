<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleClient extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'noclient';
    /* ci-dessus on indique la table a 'mapper' */
    protected $allowedFields = ['nom', 'prenom', 'adresse', 'codepostal', 'ville', 'mel', 'telephonefixe', 'telephonemobile', 'motdepasse'];
    /* champs pour lesquels insertion, et mises à jour sont autorisées
    Nota Bene : on n'autorisera pas les champs en AUTOINCREMENT */
 
    public function getClients($numeroClient = false)
    {
        if ($numeorClient === false) // pas de référence produit  en paramètre :
        {   // on retourne tous les produits
            return $this->findAll(); // SELECT * FROM produit    
        }
        // $referenceProduit != NULL : on retourne le produit correspondant (en mode objet)
        return $this->where(['noclient' => $numeroClient])->first();
        // équivalent a 'SELECT * FROM produit WHERE reference = '.$referenceProduit
    }
}
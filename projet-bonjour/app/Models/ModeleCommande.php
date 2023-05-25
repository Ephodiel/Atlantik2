<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleCommande extends Model
{
    protected $table = 'commande';
    protected $primaryKey = 'numero';
    protected $allowedFields = ['numeroclient', 'datecommande ', 'montanttotal'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT
   
    public function getAllCommandesProduits()
    {
        /* REQUETE SQL
        select numero, numeroclient, datecommande, referenceproduit, quantitecommandee, libelle, prixht
        FROM commande
            JOIN contenir
                ON commande.numero = contenir.numerocommande
            JOIN produit
                ON contenir.referenceproduit = produit.reference
        */
        $db=\Config\Database::connect();
        $builder = $db->table('commande');
        $builder->select('numero, numeroclient, datecommande, referenceproduit, quantitecommandee, libelle, prixht');
        $builder->join('contenir', 'commande.numero = contenir.numerocommande', 'inner');
        $builder->join('produit', 'contenir.referenceproduit = produit.reference',  'inner');
        return $builder->get(); /* Pour générer le tableau automatiquement, sinon
        return $builder->get()->getResult();  (voir vue associée)
        */
    }
}
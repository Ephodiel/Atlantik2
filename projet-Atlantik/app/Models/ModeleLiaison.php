<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleLiaison extends Model
{
    protected $table = 'liaison';
    protected $primaryKey = 'noliaison';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
 
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT
   
    public function getAllLiaisons()
    {
        /* REQUETE SQL
        select numero, numeroclient, datecommande, referenceproduit, quantitecomZmandee, libelle, prixht
        FROM commande
            JOIN contenir
                ON commande.numero = contenir.numerocommande
            JOIN produit
                ON contenir.referenceproduit = produit.reference
        */
         // ci-après jointure de la table 'contenir' sur $this = table 'commande' !
         // puis jointure de produit sur le résultat précédent
         // enfin on 'select' les champs a retourner
         return $this ->select('secteur.nom, noliaison, distance, d.nom as "depart", a.nom as "arrivee"')
         ->join('secteur', 'secteur.nosecteur = liaison.NOSECTEUR')
         ->join('port d', 'liaison.noport_depart = d.noport')
         ->join ('port a', 'liaison.noport_arrivee = a.noport')
         ->orderby ('secteur.nom asc')
          ->get();
          // ->get() : pour générer le tableau automatiquement,
          // si non : ->get()->getResult();  (voir vue associée)
    }
}//$sql = "select s.nom, noliaison, distance, d.nom, a.nom\n"

//. "from liaison l, port d, port a, secteur s\n"

//. "where s.nosecteur = l.NOSECTEUR and l.noport_depart = d.NOPORT and l.NOPORT_ARRIVEE = a.NOPORT;";
<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleUtilisateur extends Model
{
    protected $table = 'client'; // nom de la table mappée
    protected $primaryKey = 'noclient'; // clé primaire

    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    
    protected $allowedFields = ['mel', 'motdepasse', 'profil'];
 
} // Fin Classe
 
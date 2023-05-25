<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleUtilisateur extends Model
{
    protected $table = 'utilisateur'; // nom de la table mappée
    public function retournerUtilisateur($identifiant, $motdepasse)
    {
        return $this->where(['identifiant' => $identifiant, 'motdepasse' => $motdepasse])->first();
        // <=> SELECT * FROM utilisateur  WHERE identifiant='$pId' and motdepasse='$MotdePasse'
    } // retournerUtilisateur
 
} // Fin Classe
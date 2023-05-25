<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleUtilisateur extends Model
{
    protected $table = 'utilisateur'; // nom de la table mappée
    public function retournerUtilisateur($pId, $motDePasse)
    {
        return $this->where(['identifiant' => $pId, 'motdepasse' => $motDePasse])->first();
        // <=> SELECT * FROM utilisateur  WHERE identifiant='$pId' and motdepasse='$MotdePasse'
    } // retournerUtilisateur
} // Fin Classe
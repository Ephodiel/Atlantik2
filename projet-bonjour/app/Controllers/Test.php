<?php
namespace App\Controllers;
class Test extends BaseController
{
    public function bonjour()
    {
        return view('Test/vue_Bonjour');
        /* retour de la vue : "vue_bonjour" du dossier "Test" situé dans "Views" (pas d'affichage dans le contrôleur !) */
    }

    public function bonjourParametre($nom = 'Anonyme')
    {
        $data['nomDeLaPersonne'] = $nom;
        return view('Test/vue_BonjourParametre', $data);
        /* injection du tableau dans la vue vue_BonjourParametre */
    }

    public function bonjourNom()
    {
        if (!isset($_POST['btnOK'])) { // si le formulaire n'a pas été soumis
            helper('form');
            /* ci-dessus on charge le helper 'form" pour pouvoir utiliser les fonctions
          de ce dernier dans la génération du formulaire (vue_SaisieNom') */
            return view('test/vue_BonjourNom');

        } else { // le formulaire a été soumis
            $data['nomDeLaPersonne'] = $this->request->getPost('txtNom');
            /* récup. données formulaire (getPost), et ajout entrée dans $data */
            return view('test/vue_BonjourParametre', $data);
            /* appel vue avec injection tableau associatif $data */
        }
    }



    public function chute()
    {
        return view('Test/vue_Chute');
        /* retour de la vue : "vue_bonjour" du dossier "Test" situé dans "Views" (pas d'affichage dans le contrôleur !) */
    }


    public function chuteParametre($pesanteur = 'Anonyme')
    {
        $donnees['pesanteur'] = $pesanteur;
        return view('Test/vue_ChuteParametre', $donnees);
        /* injection du tableau dans la vue vue_BonjourParametre */
    }

    public function chuteLibre()
    {
        if (!isset($_POST['btnEnvoyer'])) 
        { // si le formulaire n'a pas été soumis
            helper('form');
            /* ci-dessus on charge le helper 'form" pour pouvoir utiliser les fonctions
          de ce dernier dans la génération du formulaire (vue_SaisieNom') */
            return view('test/vue_ChuteLibre');
        } 
        else 
        { // le formulaire a été soumis
            $pesanteur = $this->request->getPost('txtpesanteur');
            $temps = $this->request->getPost('txttemps');

            $distance = $pesanteur * $temps * $temps /2;
            $donnees['distance'] = $distance;
            return view('test/vue_ChuteParametre', $donnees);
            /* appel vue avec injection tableau associatif $data */

            
        }
    }
}
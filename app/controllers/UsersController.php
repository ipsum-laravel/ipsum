<?php

use \App\library\Liste;

class UsersController extends AdminController {
    
    public $title = 'Gestion des utilisateurs';
    public $rubrique = 'configuration';
    public $menu = 'utilisateur';
    //public static $zone = 'utilisateur';    

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = array();

        $liste = new Liste();
        $recherche = array(
            'input'     => 'mot',
            'colonnes'      => array (
                'utilisateur.nom',
                'utilisateur.prenom',
                'utilisateur.email'
            )
        );
        $liste->setRecherche($recherche);
        $tri = array(
            'ordre'     => 'ASC',
            'colonne'  => 'id'
        );
        $liste->setTri($tri);
        $requete = array(
            'colonnes'  => 'utilisateur.id,
                            utilisateur.nom,
                            utilisateur.prenom,
                            utilisateur.email',
            'from'      => 'utilisateur'
        );
        $ressource = $liste->select($requete);

        $data['datas'] = array();
        foreach($ressource as $item) {
            $data['datas'][] = $item;
        }

        $data['liste'] = $liste;

        $this->layout->content = View::make('admin.user.index', $data);
    }
   
}
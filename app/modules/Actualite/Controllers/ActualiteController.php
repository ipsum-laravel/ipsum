<?php
namespace Ipsum\Actualite\Controllers;

use \Ipsum\Library\Liste;
use \View;
use \Str;
use \Ipsum\Actualite\Models;

class ActualiteController extends \BaseController {

    public $title = 'Gestion des actualités';
    public $rubrique = 'actualite';
    public $menu = 'actualite';
    public static $zone = 'actualite';

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
                'actualite.nom',
                'actualite.description'
            )
        );
        $liste->setRecherche($recherche);
        $tri = array(
            'ordre'     => 'DESC',
            'colonne'  => 'date_actu'
        );
        $liste->setTri($tri);
        $requete = array(
            'colonnes'  => 'actualite.id,
                            actualite.nom,
                            actualite.description,
                            DATE_FORMAT(actualite.date_actu, "%d/%m/%Y") AS date_actu_format',
            'from'      => 'actualite'
        );
        $ressource = $liste->select($requete);

        $data['datas'] = array();
        foreach($ressource as $item) {
            $item->description = Str::words(strip_tags($item->description), 30, '...');
            $data['datas'][] = $item;
        }

        $data['liste'] = $liste;

        $this->layout->content = View::make('actualite.index', $data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data['actualite'] = Actualite::findOrFail($id);

        $this->layout->title = $data['actualite']->nom;
        $this->layout->content = View::make('actualite.show', $data);
	}

}
<?php

class ActualiteController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $data = array();

        //$data['actualites'] = Actualite::orderBy('date_actu', 'desc')->orderBy('id', 'desc')->paginate(5);
        
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
            $data['datas'][] = $item;
        }

        $data['liste'] = $liste;
        
        $this->layout->menus = array();
        $this->layout->title = 'Liste des actualités';
        $this->layout->content = View::make('actualite.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data['actualite'] = Actualite::find($id);

        $this->layout->menus = array();
        $this->layout->title = 'sssss';
        $this->layout->content = View::make('actualite.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
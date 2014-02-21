<?php

class ActualiteController extends \AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $data = array();

        $data['actualites'] = Actualite::orderBy('date_actu', 'desc')->orderBy('id', 'desc')->paginate(5);

        $this->layout->menus = array();
        $this->layout->title = 'Dashssssssssssssssssboard';
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
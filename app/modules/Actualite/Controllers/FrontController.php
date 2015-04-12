<?php
namespace Ipsum\Actualite\Controllers;

use View;
use Ipsum\Actualite\Models\Actualite;

class FrontController extends \BaseController {

    public function index()
    {
        $actus = Actualite::orderBy('date_actu', 'desc')->paginate(10);

        return View::make('IpsumActualite::index', compact('actus'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $actu = Actualite::findOrFail($id);
        $actu->date_actu = Carbon::createFromFormat('Y-m-d', $actu->date_actu)->formatLocalized('%A %d %B %Y');
        $actu->image = File::find('assets/media/actu/'.$actu->id.'.*', null, true);
        return View::make('IpsumActualite::show', compact('actu'));
    }

}

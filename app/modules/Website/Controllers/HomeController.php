<?php
namespace Ipsum\Website\Controllers;

use Ipsum\Actualite\Models\Actualite;
use Carbon\Carbon;
use File;
use View;
use Str;

class HomeController extends \BaseController {

	public function index()
	{
		$datas = Actualite::orderBy('date_actu', 'desc')->take(1)->get();
		foreach ($datas as $key => $actu) {
			$actu->date_actu = Carbon::createFromFormat('Y-m-d', $actu->date_actu)->formatLocalized('%A %d %B %Y');
			$actu->description = Str::words(strip_tags($actu->description), 22, '...');
			$actu->image = File::find('assets/media/actu/'.$actu->id.'.*', null, true);
			$actus[] = $actu;
		}

		return View::make('IpsumWebsite::home', compact("actus"));
	}

}
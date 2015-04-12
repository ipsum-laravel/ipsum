<?php
namespace Ipsum\Actualite\Models;

use Ipsum\Core\Models\BaseModel;
use File;

class Actualite extends BaseModel {

    protected $table = 'actualite';

    public $timestamps = false;

    public static $rules = array(
                                "date_actu" => "required|date_format:Y-m-d",
                                "nom" => "required",
                            );

    public function getImageAttribute()
    {
        return File::find('assets/media/actu/'.$this->id.'.*', null, true);
    }

    public function getDates()
    {
        return array('date_actu');
    }
}
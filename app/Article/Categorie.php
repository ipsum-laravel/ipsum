<?php
namespace App\Article;

use Ipsum\Core\Models\BaseModel;

class Categorie extends BaseModel
{
    protected $table = 'article_categorie';

    public $timestamps = false;

    const PAGE_ID = 1;
    const ACTUALITE_ID = 2;


    public function articles()
    {
        return $this->hasMany('App\Article\Article');
    }
}

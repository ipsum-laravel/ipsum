<?php
namespace App\Article;

use Ipsum\Core\Models\BaseModel;

class Categorie extends BaseModel
{
    protected $table = 'article_categorie';

    public $timestamps = false;

    public function articles()
    {
        return $this->hasMany('App\Article\Article');
    }
}

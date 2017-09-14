<?php
namespace App\Article;

use App\BaseModel;
use Config;
use Mews\Purifier\Facades\Purifier;

class Media extends BaseModel
{
    protected $table = 'media';

    protected $fillable = array('titre', 'url', 'texte');

    public static function getRules()
    {
        return array(
            "titre" => "required|max:255",
            "url" => "url|max:255",
        );
    }

    public function articles()
    {
        return $this->morphedByMany('App\Article\Article', 'publication', 'media_publication');
    }

    public function categories()
    {
        return $this->morphedByMany('App\Categorie\Categorie', 'publication', 'media_publication');
    }

    public function getPathAttribute()
    {
        return 'uploads/'.($this->repertoire != '' ? $this->repertoire.'/'.$this->fichier : $this->fichier);
    }

    public function getCropPathAttribute()
    {
        return 'uploads/crop/'.($this->repertoire != '' ? $this->repertoire.'/'.$this->fichier : $this->fichier);
    }

    public function getIconeAttribute()
    {
        return Config::has('media.types.'.$this->type.'.icone') ? Config::get('media.types.'.$this->type.'.icone') : 'default.png';
    }

    public function isImage()
    {
        return $this->type == 'image';
    }

    public function setTexteAttribute($value)
    {
        $html = Purifier::clean($value);
        $this->attributes['texte'] = $html;
    }
}

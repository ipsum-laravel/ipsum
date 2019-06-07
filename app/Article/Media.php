<?php
namespace App\Article;

use App\BaseModel;
use Config;
use Mews\Purifier\Facades\Purifier;
use File;
use Croppa;

class Media extends BaseModel
{
    protected $table = 'media';

    protected $fillable = ['titre', 'url', 'texte'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($media) {

            $repertoire = !empty($media->repertoire) ? $media->repertoire.'/' : '';

            File::deleteAll(Config::get('media.path').'crop/'.$repertoire.$media->fichier);
            Croppa::delete(Config::get('media.path').'crop/'.$repertoire.$media->fichier);

            foreach ($media->articles as $article) {
                $article->illustration()->dissociate();
                $article->save();
            }

        });
    }

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

    /*public function categories()
    {
        return $this->morphedByMany('App\Categorie\Categorie', 'publication', 'media_publication');
    }*/
	
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
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
}

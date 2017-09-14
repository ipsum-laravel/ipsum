<?php
namespace App\Article;

use App\BaseModel;
use App\Library\Markdown;
use App\Slug;
use Mews\Purifier\Purifier;
use League\CommonMark\CommonMarkConverter;

class Article extends BaseModel
{
    use Slug, Mediable {
        Slug::boot as slugBoot;
        Mediable::boot as mediaBoot;
    }

    protected $fillable = array('titre', 'extrait', 'texte_md', 'seo_title', 'seo_description', 'categorie_id', 'etat');

    protected $table = 'article';

    protected $slugBase = 'titre';

    public static function getRules()
    {
        $rules = array(
            "categorie_id" => "required|integer|exists:article_categorie,id",
            "titre" => 'required|max:255',
            "extrait" => '',
        );
        return $rules;
    }

    protected static function boot()
    {
        self::slugBoot();

        self::mediaBoot();
    }


    /*
     * Relations
     */

    public function categorie()
    {
        return $this->belongsTo('App\Article\Categorie');
    }




    /*
     * Scopes
     */

    public function scopeActualites($query)
    {
        return $query->where('categorie_id', Categorie::ACTUALITE_ID);
    }




    /*
     * Accessors & Mutators
     */

    public function isPage()
    {
        return $this->categorie_id == Categorie::PAGE_ID;
    }

    public function getDeletableAttribute()
    {
        return $this->categorie_id != Categorie::PAGE_ID;
    }

    public function getSeoTitleAttribute()
    {
        return $this->attributes['seo_title'] == '' ? $this->titre : $this->attributes['seo_title'];
    }

    public function getSeoDescriptionAttribute()
    {
        return $this->attributes['seo_description'] == '' ? $this->extrait : $this->attributes['seo_description'];
    }

    public function getUrlAttribute()
    {
        $segments = [
            Categorie::PAGE_ID => '',
            Categorie::ACTUALITE_ID => 'actualite#'
        ];

        return $segments[$this->categorie_id].$this->slug;
    }

    public function setTexteMdAttribute($value)
    {
        $this->attributes['texte_md'] = $value;
        $converter = new Markdown(new CommonMarkConverter(), new Purifier());
        $this->attributes['texte'] = $converter->convertToHtml($value);
    }
}

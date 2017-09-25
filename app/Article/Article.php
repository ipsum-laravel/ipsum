<?php
namespace App\Article;

use App\BaseModel;
use App\Library\Markdown;
use App\Article\Slug;
use Mews\Purifier\Purifier;
use League\CommonMark\CommonMarkConverter;

class Article extends BaseModel
{
    use Slug, Mediable;

    protected $fillable = ['titre', 'extrait', 'texte_md', 'seo_title', 'seo_description', 'type', 'categorie_id', 'etat'];

    protected $table = 'article';

    protected $slugBase = 'titre';

    const PAGE_ID = 'page';
    const ACTUALITE_ID = 'actualite';

    public static function getRules()
    {
        $rules = array(
            "categorie_id" => "integer|exists:article_categorie,id",
            "titre" => 'required|max:255',
            "extrait" => '',
        );
        return $rules;
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
        return $query->where('type', self::ACTUALITE_ID);
    }

    public function scopePages($query)
    {
        return $query->where('type', self::PAGE_ID);
    }




    /*
     * Accessors & Mutators
     */

    public function getDeletableAttribute()
    {
        return $this->type != self::PAGE_ID;
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

        switch ($this->type){

            case self::ACTUALITE_ID :
                return route('article.actualite', $this->slug);
        }

        return url($this->slug);
    }

    public function getTypeNomAttribute()
    {
        $noms = [self::PAGE_ID => 'Pages', self::ACTUALITE_ID => 'Actualités'];
        return isset($noms[$this->type]) ? $noms[$this->type] : null;
    }

    public function setTexteMdAttribute($value)
    {
        $this->attributes['texte_md'] = $value;
        $converter = new Markdown(new CommonMarkConverter(), new Purifier());
        $this->attributes['texte'] = $converter->convertToHtml($value);
    }



    public function isActualite()
    {
        return $this->type == self::ACTUALITE_ID;
    }

    public function isPage()
    {
        return $this->type == self::PAGE_ID;
    }
}

<?php

namespace App\Article;

use Str;
use Input;

trait Slug
{
    protected $slugChamp = 'slug';

    protected static function bootSlug()
    {

        static::creating(function ($objet) {

            if (!property_exists($objet, 'slugBase')){
                throw new \Exception("Pas de slugBase");
            }

            $base = $objet->slugBase;

            $objet->slug = Input::has('slug') ? Input::get('slug') : $objet->$base;

        });

        static::updating(function ($objet) {

            if (Input::has($objet->slugChamp)) {
                $objet->slug = Str::slug(Input::get('slug'));
            }

        });

    }

    protected function setSlugAttribute($slug)
    {
        $base = $this->slugBase;

        $slug = Str::slug($slug);

        // Renomme si slug existe déja
        $count = 1;
        while ( static::where($this->slugChamp, $slug)->where('id', '!=', $this->id === null ? 0 : $this->id)->count()) { //->withTrashed()
            $slug = Str::slug($this->$base).'('.$count++.')';
        }

        $this->attributes[$this->slugChamp] = $slug;
    }
}

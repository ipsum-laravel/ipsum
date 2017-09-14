<?php

namespace App;

use Str;

trait Slug
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($objet) {
            $base = $objet->slugBase;
            $slug = Str::slug($objet->$base);
            // Renomme si slug existe déja
            $count = 1;
            while (static::where('slug', $slug)->count()) { //->withTrashed()
                $slug = Str::slug($objet->$base).'('.$count++.')';
            }
            $objet->slug = $slug;
        });
    }
}

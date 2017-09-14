<?php

namespace App\Article;

use Session;

trait Mediable
{
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($objet) {
            if (Session::has('media.publications')) {
                foreach (Session::get('media.publications') as $medias) {
                    $media = Media::findOrFail($medias['media_id']);
                    $objet->medias()->attach($media);
                }
                Session::forget('media.publications');
            }

            if (!$objet->illustration()->count() and $objet->medias()->count()) {
                $media = $objet->medias()->first();
                $objet->illustration()->associate($media)->save();
            }
        });
    }


    public function medias()
    {
        return $this->morphToMany('App\Article\Media', 'publication', 'media_publication');
    }

    public function illustration()
    {
        return $this->belongsTo('App\Article\Media', 'media_id');
    }
}

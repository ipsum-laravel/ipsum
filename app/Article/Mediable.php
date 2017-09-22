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

            if ($objet->media_id === null and $objet->medias()->images()->count()) {
                $media = $objet->medias()->images()->first();
                $objet->media_id = $media->id;
                $objet->save();
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

<?php

namespace App\Article;

use Session;

trait Mediable
{

    protected static function bootMediable()
    {

        static::saved(function ($objet) {

            // Association des medias uploadés avant enregistrement de la publication
            if (Session::has('media.publications')) {
                foreach (Session::get('media.publications') as $medias) {
                    $media = Media::findOrFail($medias['media_id']);
                    $objet->medias()->attach($media);
                }
                Session::forget('media.publications');
            }

            // Illustration automatique de la publication si elle n'en as pas encore
            if ($objet->media_id === null and $objet->medias()->images()->count()) {
                $media = $objet->medias()->images()->first();
                $objet->media_id = $media->id;
                $objet->save();
            }
        });

        static::deleting(function ($objet) {
            $objet->medias()->detach();
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

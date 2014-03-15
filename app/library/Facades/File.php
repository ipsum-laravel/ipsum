<?php namespace Ipsum\Library\Facades;

use Illuminate\Support\Facades\Facade;

class File extends Facade {

    protected static function getFacadeAccessor()
    {
        return new \Ipsum\Library\Filesystem;
    }

}
<?php

class actualite extends BaseModel {

    protected $table = 'actualite';

    public $timestamps = false;

    public static $rules = array(
                                "date_actu" => "required|date_format:Y-m-d",
                                "nom" => "required",
                            );
}
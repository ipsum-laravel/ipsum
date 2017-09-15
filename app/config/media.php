<?php

return array(

    'path' => 'uploads/',

    'repertoires' => array(
        'article',
    ),

    'types' => array(
        'image' => array(
            'type' => 'image',
            'mimes' => array('jpeg', 'jpg','png','bmp','gif'),
        ),
        'document' => array(
            'type' => 'document',
            'mimes' => array('pdf'),
            'icone' => 'document.png',
        ),
    )

);

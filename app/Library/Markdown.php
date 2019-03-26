<?php
namespace App\Library;

use Config;
use Croppa;
use Validator;
use Symfony\Component\HttpFoundation\File\File;

class Markdown
{

    /**
     * Dépendances
     */
    protected $parseur;
    protected $htmlFilteur;

    public function __construct($parseur, $htmlFilteur)
    {
        $this->parseur = $parseur;
        $this->htmlFilteur = $htmlFilteur;
    }

    public function convertToHtml($markdown)
    {
        $markdown = $this->parsePlugin($markdown);
        $html =  $this->parseur->convertToHtml($markdown);
        $html = $this->htmlFilteur->clean($html);

        return $html;
    }

    protected function parsePlugin($texte)
    {
        // TODO : Ne pas prendre caractères html
        $pattern = '/^!([a-z]*)\[(.*)\]\((.*)\)\s*$/m';

        $texte = preg_replace_callback(
            $pattern,
            function ($matches) {
                switch ($matches[1]) {
                    case 'media':
                        return $this->media($matches, true);
                        break;
                    case 'bouton':
                        return $this->bouton($matches);
                        break;
                    default:
                        return $matches[0];
                        break;
                }
            },
            $texte
        );

        $pattern = '/!([a-z]*)\[(.*)\]\((.*)\)/m';
        $texte = preg_replace_callback(
            $pattern,
            function ($matches) {
                switch ($matches[1]) {
                    case 'media':
                        return $this->media($matches);
                        break;

                    default:
                        return $matches[0];
                        break;
                }
            },
            $texte
        );

        return $texte;
    }

    protected function bouton($texte)
    {
        $titre = $texte[2];
        $arguments = explode('|', $texte[3]);

        $href = $arguments[0];

        $html = '<div class="ta-c mt-30">
                    <a href="'.url($href).'" class="btn-d">
                        <span class="txt">'.$titre.'</span>
                        <span class="arrow-wp"><span class="sprite arrow-b">&nbsp;</span></span>
                    </a>
                </div>'."\n\r";
        return $html;
    }


    protected function media($texte, $block = false)
    {
        $titre = $texte[2];
        $arguments = explode('|', $texte[3]);

        $fichier = $arguments[0];

        $type = in_array(pathinfo($fichier, PATHINFO_EXTENSION), ['jpeg','jpg','png','bmp','gif']) ? 'image' : 'document';

        $class = "";
        if (isset($arguments[1])) {
            $class = $arguments[1];
        }

        $largeur = isset($arguments[2]) ? $arguments[2] : null;
        $hauteur = isset($arguments[3]) ? $arguments[3] : null;

        if ($type == 'image') {
            $img = $largeur ? Croppa::url('/'.Config::get('media.path').'crop/'.$fichier, $largeur, $hauteur) : '/'.Config::get('media.path').$fichier;
            $media = '<img class="'.$class.' img-responsive" src="'.$img.'" alt="'.$titre.'">';
        } else {
            $media = '<a href="'.'/'.Config::get('media.path').$fichier.'">'.$titre.'</a>';
        }
        $html = $block ? $media."\n\r" : $media;
        return $html;
    }
}

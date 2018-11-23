<?php
namespace App\Controllers\Admin;

use View;
use Input;
use Redirect;
use Session;
use Str;
use File;
use Config;
use Response;
use Validator;
use Request;
use Liste;
use HTML;
use App\Article\Media;


class MediaController extends \Ipsum\Admin\Controllers\BaseController
{
    public $title = 'Gestion des médias';
    public $rubrique = 'media';
    public $menu = 'media';
    public static $zone = 'media';

    public function index()
    {
        $requete = Media::query();
        $liste = Liste::setRequete($requete);
        $filtres = array(
            array(
                'nom' => 'mot',
                'operateur' => 'like',
                'colonnes' => array(
                    'media.titre',
                ),
            ),
            array(
                'nom' => 'repertoire',
                'colonnes' => 'media.repertoire',
            ),
            array(
                'nom' => 'type',
                'colonnes' => 'media.type',
            ),
        );
        Liste::setFiltres($filtres);
        $tris = array(
            array(
                'nom' => 'date',
                'ordre' => 'desc',
                'colonne' => 'created_at',
                'actif' => true,
            ),
            array(
                'nom' => 'titre',
            ),
            array(
                'nom' => 'type',
            ),
            array(
                'nom' => 'repertoire',
            ),
        );
        Liste::setTris($tris);

        $medias = Liste::rechercherLignes();

        $types[''] = '----- Type ------';
        foreach (Config::get('media.types') as $type) {
            $types[$type['type']] = $type['type'];
        }
        $repertoires[''] = '----- Répertoire ------';
        foreach (Config::get('media.repertoires') as $repertoire) {
            $repertoires[$repertoire] = $repertoire;
        }

        $this->layout->content = View::make('media.admin.index', compact('medias', 'types', 'repertoires'));
    }


    public function upload()
    {
        $succes = $error = $messages = null;
        $medias = $views = array();

        $files = Input::file('medias');
        if (!is_array($files)) {
            $files[] = $files;
        }

        $mimes = array();
        foreach (Config::get('media.types') as $type) {
            $mimes = array_merge($mimes, $type['mimes']);
        }
        $mimesAccepted = implode(',', $mimes);

        $repertoire = (Input::has('repertoire') and in_array(Input::get('repertoire'), Config::get('media.repertoires'))) ? Input::get('repertoire').'/' : '';

        foreach ($files as $file) {
            $rules = array($file->getClientOriginalName()  => 'mimes:'.$mimesAccepted.'|max:10000');
            $datas = array($file->getClientOriginalName() => $file);
            $validation = Validator::make($datas, $rules);
            if ($validation->passes()) {
                try {
                    $extension = strtolower(File::extension($file->getClientOriginalName()));
                    $basename = basename($file->getClientOriginalName(), '.'.$extension);
                    $titre = str_replace(array('-', '_'), ' ', $basename);
                    $basename = Str::slug($basename);
                    $filename = $basename.'.'.$extension;

                    // Renomme si fichier existe déja
                    $count = 1;
                    while (File::exists(Config::get('media.path').$repertoire.$filename)) {
                        $filename = $basename.'('.$count++.').'.$extension;
                    }

                    // Récupèration du type de fichier
                    $type = null;
                    foreach (Config::get('media.types') as $value) {
                        if (in_array($extension, $value['mimes'])) {
                            $type = $value['type'];
                            break;
                        }
                    }

                    // Enregistrement du fichier
                    $file->move(Config::get('media.path').$repertoire, $filename);

                    // Enregistrement en bdd
                    $media = new Media;
                    $media->titre = $titre;
                    $media->fichier = $filename;
                    $media->type = $type;
                    $media->repertoire = str_replace('/', '', $repertoire);
                    $media->save();

                    // Enregistrement de la publication associé
                    if (Input::has('publication_id') and Input::has('publication_type')) {
                        $data = $this->_publication(Input::get('publication_type'), Input::get('publication_id'));
                        $data->medias()->attach($media);

                        // Déclenchement event saved pour enregistrer l'illustration sur la première image
                        $data->save();
						
                    } elseif (Input::has('publication_type')) {
                        // Cas des médias qui ne sont pas encore associé à une pulbication
                        // Cas de l'upload avant la création de la publication
                        $mediaPublications[] = array(
                            'publication_type' => Input::get('publication_type'),
                            'media_id' => $media->id
                        );
                        if (Session::has('media.publications')) {
                            $mediaPublications = array_merge(Session::get('media.publications'), $mediaPublications);
                        }
                        Session::put('media.publications', $mediaPublications);
                    }

                    $views[] = View::make(
                        Input::has('media_view') ? Input::get('media_view') : 'media.admin._media',
                        compact('media')
                    )->render();

                    $medias[] = $media;

                    $succes[] = "Le média ".$file->getClientOriginalName()." a bien été téléchargé";
                } catch (\RuntimeException $e) {
                    $error[] = "Votre média ".$file->getClientOriginalName()." est trop lourd.";
                } catch (\Exception $e) {
                    $error[] =  "Impossible de télécharger le média ".$file->getClientOriginalName();
                }
            } else {
                $messages = $validation->messages();
                foreach ($messages->all() as $message) {
                    $error[] =  $message;
                }
            }
        }

        Session::flash('success', $succes);
        Session::flash('error', $error);

        if (Request::ajax()) {
            $notifications = HTML::notifications(null, 'IpsumAdmin::partials.notifications');
            Session::forget('success');
            Session::forget('error');
            return Response::json(
                array(
                    'errors' => ($error === null ? 0 : $error),
                    'medias' => $medias,
                    'notifications' => $notifications,
                    'views' => $views,
                )
            );
        }
        return Redirect::back();
    }

    public function edit($id)
    {
        $data = Media::findOrFail($id);
        $this->layout->content = View::make('media.admin.form', compact('data'));
    }

    public function update($id)
    {
        $data = Media::findOrFail($id);

        $validation = Media::validate(Input::all());

        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }

        if ($data->fill(Input::all())->save()) {
            Session::flash('success', "L'enregistrement a bien été modifié");
            return Redirect::back();
        } else {
            Session::flash('error', "Impossible de modifier l'enregistrement");
            return Redirect::back()->withInput();
        }
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        $media->delete();

        Session::flash('warning', "Le media a bien été supprimé");

        return Redirect::back();
    }

    public function illustrer($id)
    {
        $media = Media::findOrFail($id);

        $publication = $this->_publication(Input::get('publication_type'), Input::get('publication_id'));

        $publication->illustration()->associate($media)->save();

        Session::flash('success', "L'image d'illustration a été enregistrée.");

        return Redirect::back();
    }

    protected function _publication($type, $id)
    {
        if (class_exists($type) and method_exists($type, 'medias')) {
            return $type::findOrFail($id);
        }
        \App::abort(422);
    }
}

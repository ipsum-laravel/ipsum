<h2>{{ isset($article) ? 'Modification' : 'Nouvel' }} article</h2>
{{ Form::open(
        [
            'route' => isset($article) ? ['admin.article.update', $article->id] : 'admin.article.store',
            'class' => 'saisie',
            'id' => 'article',
            'method' => isset($article) ? 'PUT' : 'POST'
        ]
    ) }}
    <div class="bloc_left">
        <fieldset>
            <legend>Description</legend>
            <p class="oblig{{ $errors->has('titre') ? ' form_erreur' : '' }}">
                {{ Form::label('titre', 'Titre') }}
                {{ Form::text('titre', isset($article) ? $article->titre : null) }}
            </p>
            <p class="{{ $errors->has('categorie_id') ? ' form_erreur' : '' }}">
                {{ Form::label('categorie_id', 'Catégorie') }}
                {{ Form::select('categorie_id', ['' => '----- Catégories -----'] + $categories, isset($article) ? $article->categorie_id : null) }}
            </p>
            <input type="hidden" name="type" value="{{ isset($article) ? $article->type : Input::get('type') }}">
            <p class="{{ $errors->has('extrait') ? ' form_erreur' : '' }} champ_max">
                {{ Form::label('extrait', 'Extrait') }}
                {{ Form::textarea('extrait', isset($article) ? $article->extrait : null, ['rows' => 5]) }}
            </p>
            <div class="{{ $errors->has('texte_md') ? ' form_erreur' : '' }} p champ_max">
                {{ Form::label('texte_md', 'Texte') }}
                <div class="markItUpHelp">
                    <table class="markItUpHelp-table">
                        <tr>
                            <th>Saisir</th>
                            <th>Pour afficher</th>
                        </tr>
                        <tr>
                            <td>## texte</td>
                            <td>## titre de niveau 2 (H2)</td>
                        </tr>
                        <tr>
                            <td>### texte</td>
                            <td>### titre de niveau 3 (H3)</td>
                        </tr>
                       <tr>
                            <td>**texte**</td>
                            <td><strong>texte en gras</strong></td>
                        </tr>
                       <tr>
                            <td>_texte_</td>
                            <td><em>texte italique</em></td>
                        </tr>
                       <tr>
                            <td>- texte</td>
                            <td>. liste non ordonnée</td>
                        </tr>
                       <tr>
                            <td>1- texte</td>
                            <td>1 liste ordonnée</td>
                        </tr>
                       <tr>
                            <td>![texte alternatif](http://lien.com)</td>
                            <td>une image</td>
                        </tr>
                       <tr>
                            <td>[texte](http://example.com)</td>
                            <td><a href="http://example.com">texte</a></td>
                        </tr>
                    </table>
                </div>
                {{ Form::textarea('texte_md', isset($article) ?  $article->texte_md : null, ['class' => 'markItUp', 'rows' => 15]) }}
            </div>
        </fieldset>
        @if (Auth::user()->isSuperAdmin())
        <fieldset>
            <legend>SEO</legend>
            <p>
                {{ Form::label('seo_title', 'Balise title') }}
                {{ Form::text('seo_title', isset($article) ? $article->seo_title : null) }}
            </p>
            <p>
                {{ Form::label('seo_description', 'Balise description') }}
                {{ Form::text('seo_description', isset($article) ? $article->seo_description : null) }}
            </p>
            <p>
                {{ Form::label('slug', 'Slug (laisser vide de préfèrence)') }}
                {{ Form::text('slug') }}
                @if (isset($article))
                <br><br><span class="textNote">Slug actuel : {{ $article->slug }}</span>
                @endif
            </p>
        </fieldset>
        @endif
        <p>
            <label for="submit">&nbsp;</label>
            {{ Form::submit('Enregistrer', ['id' => 'article_submit', 'class' => 'submit']) }}
        </p>
    </div>
{{ Form::close() }}

<div class="bloc_right">
    <h3>Téléchargement des fichiers</h3>
    {{ Form::open(
        [
            'route' => ['admin.media.upload'],
            'method' => 'PUT',
            'files' => true
        ]
    ) }}
        <div id="fileupload">
            {{ Form::hidden('publication_id', isset($article) ? $article->id : null) }}
            {{ Form::hidden('publication_type', 'App\\Article\\Article') }}
            {{ Form::hidden('repertoire', 'article') }}
            <input name="medias[]" id="files" type="file" multiple="multiple">
            <input name="submit" type="submit" value="Télécharger">
        </div>
    {{ Form::close() }}
    <div id="fileupload-message"></div>

    <h3 style="margin-top: 20px;">Liste des fichiers</h3>
    <div id="medias">
    @if (isset($article) and $article->medias->count())
        @foreach ($article->medias as $media)
        <div class="media{{ $article->media_id == $media->id ? ' media-illustration' : '' }}">
            <a class="markItUpAddMedia media-image" href="{{ asset($media->path) }}" title="{{{ $media->titre }}}" data-fichier="{{{ $media->repertoire }}}/{{{ $media->fichier }}}">
                @if ($media->isImage())
                <img src="{{ Croppa::url('/'.$media->cropPath, 150, 150) }}" alt="" />
                @else
                <img src="{{ asset('admin/img/'.$media->icone) }}" alt="{{{ $media->type }}}" />
                @endif
            </a>
            <div class="media-details">
                <div class="media-menu">
                    <div>
                        <a href="{{ route('admin.media.edit', $media->id) }}"><img src="{{ asset('packages/ipsum/admin/img/modifier.png') }}" alt="Modifier"></a>
                    </div>
                    @if ($media->isImage() and $article->media_id != $media->id)
                    {{ Form::open(['method' => 'PUT', 'route' => ['admin.article.illustrer', $article->id]]) }}
                        <div>
                            <input type="hidden" name="media_id" value="{{ $media->id }}" />
                            <input title="Illustrer l'article avec cette image" type="image" src="{{ asset('admin/img/picture_add.png') }}" value="Illustrer">
                        </div>
                    {{ Form::close() }}
                    @endif
                    {{ Form::open(['method' => 'DELETE', 'route' => ['admin.media.destroy', $media->id]]) }}
                        <div>
                            <input title="Supprimer le média" type="image" src="{{ asset('packages/ipsum/admin/img/supprimer.png') }}" value="Supprimer" class="supprimer" data-message="{{{ $media->titre }}}">
                        </div>
                    {{ Form::close() }}
                </div>
                @if ($media->isImage())
                <p>
                    <label>Taille</label>
                    <select name="taille" class="taille">
                        <option value="250">Petite taille</option>
                        <option value="700">Grande taille</option>
                        <option value="">Original</option>
                    </select>
                </p>
                <p>
                    <label>Alignement</label>
                    <select name="alignement" class="alignement">
                        <option value="">---</option>
                        <option value="img-left">Centré</option>
                        <option value="left">Gauche</option>
                        <option value="right">Droite</option>
                    </select>
                </p>
                @endif
                <p>
                    <a class="markItUpAddMedia"
                        href="{{ asset($media->path) }}"
                        title="{{{ $media->titre }}}"
                        data-fichier="{{{ $media->repertoire }}}/{{{ $media->fichier }}}">
                            Ajouter {{{ $media->titre }}}
                    </a>
                </p>
            </div>
       </div>
    @endforeach
    @endif
    </div>
</div>

<!--  fileupload -->
<script src="{{ asset('packages/ipsum/admin/js/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('admin/js/jquery.knob.js') }}"></script>
<script src="{{ asset('admin/js/jquery.iframe-transport.js') }}" ></script>
<script src="{{ asset('admin/js/jquery.fileupload.js') }}" ></script>
<script src="{{ asset('admin/js/jquery.formFileupload.js') }}" ></script>
<script>
    $(function() {
        // Alerte au moment de quitter la page
        $('#article').data('serialize',$('#article').serialize());
        $('#article').on('submit', function(e){
            $(window).off('beforeunload');
        });
        $(window).on('beforeunload', function(e){
            if($('#article').serialize() != $('#article').data('serialize')) return true;
            else e=null;
        });

        function markItUpAddMedia() {
            $(".markItUpAddMedia").click(function() {
                var src = $(this).data("fichier");
                var alt = $(this).attr("title");

                var arguments = []
                arguments.push(src);
                var alignement = $(this).parents('.media').find('.alignement option:selected').val();
                if (typeof alignement !== "undefined") {
                    arguments.push(alignement);
                }
                taille = $(this).parents('.media').find('.taille option:selected').val();
                if (typeof taille !== "undefined" && taille != "") {
                    arguments.push(taille);
                }
                $.markItUp({
                    _____target: ".markItUp",
                    openWith: "!media[",
                    closeWith: "](" + arguments.join('|') + ")",
                    placeHolder: alt
                });
                return false;
            });
        }
        markItUpAddMedia();
        // Préselectione le bon textarea pour add media
        $.markItUp({ target: "#fr[texte_md]" });

        $("#fileupload").formFileupload({
            "afterDone" : function (e, data) {
                $("#medias").prepend(rendered);
                markItUpAddMedia();
            }
        });
    });
</script>

<style>
    .fileupload {
        padding: 20px;
        background-color: #fafafa;
        border: dashed 4px #9f9f9f;

        text-align: center;
    }
    .fileupload-hover {
        border-color: #dedede;
    }
    .fileupload-error {
        border: dashed 4px red;
    }
    .fileupload input{
        display:none;
    }

    .media {
        overflow: hidden;
        margin-bottom: 10px;
        padding: 5px;
        background: #f5f5f5;
        text-align: right;
    }
        .media-illustration {
            background: #d7d7d7;
        }
        .media-details {
            float: right;
            width: 170px;
        }
            .media-menu > * {
                display: inline-block;
            }
            .media label {
                display: inline-block;
                width: 50%;
                text-align: right;
            }
            .media select {
                width: 45%;
            }
</style>

<h2>{{ isset($article) ? 'Modification' : 'Nouvel' }} article</h2>
{{ Form::open([
        'route' => isset($article) ? ['admin.article.update', $article->id] : 'admin.article.store',
        'class' => 'saisie',
        'id' => 'formulaire',
        'method' => isset($article) ? 'PUT' : 'POST'
    ]) }}
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
    {{-- Uploads des fichiers --}}
    @include('media.admin._uploads', [
        'publication' => isset($article) ? $article : null,
        'publication_type' => 'App\\Article\\Article',
        'dossier' => 'article',
        'markItUpAddMedia_textarea_id' => 'texte_md', // null si pas besoin de addMedia
    ])
</div>

<script>
    $(function() {
        // Alerte au moment de quitter la page si les champs ne sont pas enregistrées
        $('#formulaire').data('serialize',$('#formulaire').serialize());
        $('#formulaire').on('submit', function(e){
            $(window).off('beforeunload');
        });
        $(window).on('beforeunload', function(e){
            if($('#formulaire').serialize() != $('#formulaire').data('serialize')) return true;
            else e=null;
        });
    });
</script>


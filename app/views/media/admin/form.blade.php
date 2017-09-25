<h2>Modification media</h2>
{{ Form::open([
        'route' => array('admin.media.update', $data->id),
        'class' => 'saisie',
        'method' => 'PUT'
    ]) }}
    <div class="bloc_left">
        <p class="oblig{{ $errors->has('titre') ? ' form_erreur' : '' }}">
            {{ Form::label('titre', 'Titre') }}
            {{ Form::text('titre', $data->titre) }}
        </p>
        <p class="{{ $errors->has('titre') ? ' form_erreur' : '' }}">
            {{ Form::label('text', 'Texte') }}
            {{ Form::textarea('texte', $data->texte, ['id' => 'text']) }}
        </p>
        <p class="{{ $errors->has('url') ? ' form_erreur' : '' }}">
            {{ Form::label('url', 'Lien') }}
            {{ Form::text('url', $data->url) }}
        </p>
        <p>
            <label for="submit">&nbsp;</label>
            {{ Form::submit('Enregistrer', array('id' => 'submit', 'class' => 'submit')) }}
        </p>
    </div>
{{ Form::close() }}
<div class="bloc_right">
    <a href="{{ $data->path }}"><img src="{{ Croppa::url('/'.$data->cropPath, 330, 250) }}" alt=""></a>
</div>

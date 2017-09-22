@extends('layouts.website')
@section('title', e($article->seoTitle))
@section('description', e($article->seoDescription))

@section('content')

<h1>{{{ $article->titre }}}</h1>

<h2>Nos coordonnées</h2>
<div class="vcard">
    <p>
        <strong class="fn">{{{ Config::get('website.nom') }}}</strong>
    </p>
    <p>
        <strong>Adresse :</strong><br>
        <span class="street-address">{{{ Config::get('website.adresse') }}}</span><br>
        <span class="postal-code">{{{ Config::get('website.cp') }}}</span> - <span class="locality">{{{ Config::get('website.ville') }}}</span><br>
        <strong>Téléphone :</strong> <span class="tel">{{{ Config::get('website.telephone') }}}</span><br>
        <strong>GSM :</strong> <span>{{{ Config::get('website.gsm') }}}</span><br>
        <strong>Fax :</strong> {{{ Config::get('website.fax') }}}<br>
        <!--<strong>Courriel :</strong> <?php /* HTML::mailto(Config::get('website.email')) */ ?> -->
    </p>
</div>
<h2>Envoyez-nous un message</h2>
{{ HTML::notifications($errors) }}
{{ Form::open(array('route' => array('contact.send'), 'method' => 'POST', 'class' => 'saisie2')) }}
    <p class="oblig{{ $errors->has('nom') ? ' form_erreur' : '' }}">
        {{ Form::label('nom', 'Nom') }}
        {{ Form::text('nom') }}
    </p>
    <p class="oblig{{ $errors->has('email') ? ' form_erreur' : '' }}">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email') }}
    </p>
    <p>
        {{ Form::label('telephone', 'Téléphone') }}
        {{ Form::text('telephone') }}
    </p>
    <p class="oblig{{ $errors->has('texte') ? ' form_erreur' : '' }}">
        {{ Form::label('texte', 'Message') }}
        {{ Form::textarea('texte') }}
    </p>
    <p>
        <input name="submit" id="submit" type="submit" value="Envoyer">
    </p>
{{ Form::close() }}

@stop

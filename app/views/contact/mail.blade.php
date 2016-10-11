@extends('layouts.email')

@section('content')
    <p>Bonjour,</p>

    <p>Vous avez reçu un nouveau message en provenance du site <a href="{{{ Config::get('app.url') }}}">{{{ Config::get('IpsumCore::website.nom_site') }}}</a></p>

    <p>
        <strong>Nom :</strong> {{{ $nom }}}<br />
        <strong>Email :</strong> {{{ $email }}}<br />
        <strong>Téléphone :</strong> {{{ $telephone }}}<br />
        <strong>Message :</strong><br />
    </p>

    <p>
        {{ nl2br(e($texte)) }}
    </p>
@stop

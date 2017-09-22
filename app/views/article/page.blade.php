@extends('layouts.website')
@section('title', e($article->seoTitle))
@section('description', e($article->seoDescription))

@section('content')

    <h1>{{{ $article->titre }}}</h1>
    @if($article->illustration)
        <img src="{{ Croppa::url($article->illustration->cropPath, 1050) }}" alt="{{{ $article->illustration->titre }}}">
    @endif
    {{ $article->texte }}

@stop
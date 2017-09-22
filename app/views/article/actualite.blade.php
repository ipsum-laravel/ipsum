@extends('layouts.website')
@section('title', e($actualite->seoTitle))
@section('description', e($actualite->seoDescription))

@section('content')

    <h1>{{{ $actualite->titre }}}</h1>
    <div>{{ $actualite->updated_at->diffForHumans() }}</div>
    <div>
        @if($actualite->illustration)
            <img src="{{ Croppa::url($actualite->illustration->cropPath, 1050) }}" class="img-center" alt="{{{ $actualite->illustration->titre }}}">
        @endif
        {{ $actualite->texte }}
    </div>

@stop
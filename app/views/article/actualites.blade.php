@extends('layouts.website')
@section('title', 'Nos actualités')
@section('description')

@section('content')

    <h1>Actualités</h1>
    <ul>
        @foreach ($actualites as $actualite)
        <li>
            <a href="{{{ route('article.actualite', $actualite->slug) }}}">
                @if($actualite->illustration)
                    <div>
                        <img src="{{ Croppa::url($actualite->illustration->cropPath, 150, 150) }}" class="sr-only" alt="{{{ $actualite->illustration->titre }}}">
                    </div>
                @endif
                <h2>{{{ $actualite->titre }}}</h2>
                <div>{{ $actualite->updated_at->diffForHumans() }}</div>
                <p>{{ nl2br(e($actualite->extrait)) }} </p>
            </a>
        </li>
        @endforeach
    </ul>

@stop
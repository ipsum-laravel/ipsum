@extends('layouts.website')
@section('title', 'Actualités')
@section('description')

@section('content')
    <h1>Les actualités</h1>
    @foreach ($actus as $actu)
    <article class="box1 pas plm mbm">
        <h2 id="actu_{{ $actu->id }}">{{{ $actu->nom }}}</h2>
        <p>{{ $actu->date_actu->format('d/j/Y') }}</p>
        @if ($actu->image)
        <img src="{{ Croppa::url('/'.$actu->image, 350) }}" alt="" class="right">
        @endif
        <p>{{ Str::words(strip_tags($actu->description), 22, '...') }}</p>
    </article>
    @endforeach
    {{ $actus->links() }}

@stop


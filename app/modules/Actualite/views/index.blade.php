@extends('layouts.website')
@section('title')Actualités @stop
@section('description') @stop

@section('content')
    <h1>Les actualités</h1>
    @foreach ($actus as $actu)
    <article class="box1 pas plm mbm">
        <h2 id="actu_{{ $actu->id }}">{{{ $actu->nom }}}</h2>
        <p>{{ $actu->date_actu }}</p>
        @if ($actu->image)
        <img src="{{ Croppa::url('/'.$actu->image, 350) }}" alt="" class="right">
        @endif
        {{ $actu->description }}
    </article>
    @endforeach
    {{ $actus->links() }}

@stop


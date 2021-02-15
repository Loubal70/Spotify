@extends('templates.general')

@section('contenu')
    <h1>Recherche {{$search}}</h1>

    <h4>Utilisateurs</h4>

    @foreach ($users as $u)
      <a href="/search/{{$u->id}}">{{$u->name}}</a>
    @endforeach

    <h4>Chansons</h4>
    @include('partials._songs')


@endsection

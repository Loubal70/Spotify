@extends('templates.general')

@section('contenu')
    <h1>{{ __('Recherche')}} {{$search}}</h1>

    <h4>{{ __('Utilisateurs')}}</h4>

    @foreach ($users as $u)
      <a href="/search/{{$u->id}}">{{$u->name}}</a>
    @endforeach

    <h4>{{ __('Chansons')}}</h4>
    @include('partials._songs')


@endsection

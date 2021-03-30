@extends('templates.general')

@section('contenu')
    <h1 class="text-white">{{ __('Recherche')}} {{$search}}</h1>

    <h4 class="text-white">{{ __('Utilisateurs')}}</h4>

    @foreach ($users as $u)
      <a class="text-white" href="/search/{{$u->id}}">{{$u->name}}</a>
    @endforeach

    <h4 class="text-white">{{ __('Chansons')}}</h4>
    @include('partials._songs')


@endsection

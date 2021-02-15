@extends("templates.general")

@section('contenu')

<h1>Bienvenue chez {{$user->name}}</h1>


<h4>Quelques infos</h4>
  Propriétaire de {{$user->songs->count()}} chansons

<br>
Suivis par {{$user->TheyLikeMe->count()}} personnes et il suit {{$user->ILikeThem->count()}} personnes
<br>

@auth
  @if (Auth::id() != $user->id)
    {{-- Est-ce que je suis cette personne --}}
    @if (Auth::user()->ILikeThem->contains($user->id))
      {{-- Je suis cette personne --}}
      <a href="/changeLike/{{$user->id}}">Vous suivez déjà cette personne</a>

      @else
        {{-- Non, je ne suis pas cette personne --}}
        <a href="/changeLike/{{$user->id}}">Suivre</a>
    @endif
  @endif
@endauth

<h4>Mes chansons préférés</h4>
@include('partials._songs', ['songs' => $user->songs])


@endsection

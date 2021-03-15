@extends("templates.general")

@section('contenu')

  <div class="container-fluid profil">
    <div class="row justify-content-center justify-content-lg-start my-5">
      <div class="col-12 col-lg-4 imgBox">
        {{-- Photo de profil --}}
      </div>
      <div class="col-12 col-lg-8">
        {{-- Résumé --}}
          {{-- Description --}}
          <h5>Résumé de {{$user->name}}</h5>
          <p>{{$user->name}} est suivis par {{$user->TheyLikeMe->count()}} personnes grâce à ses {{$user->songs->count()}} chansons publiées ! Il suit {{$user->ILikeThem->count()}} personnes</p>
          @if ($user->description)
            <p {{Auth::check() && Auth::id() == $user->id ? "contenteditable" : ""}} id="description">
              {!! $user->description !!}
            </p>
            @else
              <p {{Auth::check() && Auth::id() == $user->id ? "contenteditable" : ""}} id="description">
                <i>Description par défault, merci de renseigner vos informations</i>
              </p>
          @endif
          @if (Auth::check() && Auth::id() == $user->id)
            <form method="post" action="/users/updatedescription" id="descriptionform" data-pjax>
              @csrf
              <input type="hidden" name="description">
              <button type="submit" class="btn btn-primary">Valider</button>
            </form>
          @endif

          @auth
            @if (Auth::id() != $user->id)
              {{-- Est-ce que je suis cette personne --}}
              @if (Auth::user()->ILikeThem->contains($user->id))
                {{-- Je suis cette personne --}}
                <a  class="btn btn-primary" href="/changeLike/{{$user->id}}">Vous suivez déjà cette personne</a>

                @else
                  {{-- Non, je ne suis pas cette personne --}}
                  <a class="btn btn-primary" href="/changeLike/{{$user->id}}">Suivre</a>
              @endif
            @endif
          @endauth
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-4">
        {{-- Titres --}}
        <h5>Les derniers titres</h5>
        @include('partials._songs', ['songs' => $user->songs])
        <pre>
        @php
          var_dump($user->songs);
        @endphp
        </pre>
      </div>
      <div class="col-12 col-md-8">
        {{-- Album / Playlist --}}
        <h5>Albums & Mixtapes</h5>
      </div>
    </div>
  </div>

@endsection

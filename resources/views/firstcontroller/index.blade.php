@extends("templates.general")

@section('contenu')

  @if (Request::is('/'))
    @guest
      <div class="col-12 text-center">
        <h1 class="header_title">Une nouvelle <br>expérience <span>auditive</span></h1>
        <h2>Découvrez une nouvelle interface pour votre service de <br>streaming préféré. Inscrivez vous pour en savoir plus !</h2>
        <a href="{{ route('register') }}" class="btn btn-secondary mt-3">S'inscrire &#8594;</a>

        <img class="homepage" src="/img/homepage.svg" alt="HomePage">
      </div>
    @endguest
  @endif

@auth
  <h1>Musiques disponibles</h1>

  @include('partials._songs', ["songs" => $songs])

{{-- Fermeture container --}}
</div>


@endauth

@endsection

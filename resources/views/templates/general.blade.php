<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>CloudBeat - {{ __("Le son comme vous ne l'avez jamais entendu")}}</title>
    <meta charset="UTF-8">
    <meta name="description" content="SpotiLike est un projet Laravel étudiant">
    <meta name="keywords" content="portfolio, riddle, onepage, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" />

    <!-- Chargement des icones -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/toastr.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/responsive.css">
    <!--[if lt IE 9]>
    	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script src='/js/jquery.pjax.js'></script>
    <script src="/js/toastr.min.js"></script>
  </head>
  <body>

    <header class="container mt-5">
      <div class="row align-items-center">
        <div class="d-flex col-12 col-lg-6 align-items-center">
          <svg class="d-none d-lg-block" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M22.5 4.13635V20.6364C22.5 21.8785 21.4922 22.8864 20.25 22.8864H3.75C2.50781 22.8864 1.5 21.8785 1.5 20.6364V4.13635C1.5 2.89417 2.50781 1.88635 3.75 1.88635H20.25C21.4922 1.88635 22.5 2.89417 22.5 4.13635ZM9.88125 10.2629C9.88125 9.43323 9.23906 9.23635 8.52656 9.23635H6.67031V11.3364H8.67188C9.37969 11.3364 9.88125 11.027 9.88125 10.2629ZM10.2422 14.1207C10.2422 15.0254 9.58594 15.3114 8.77969 15.3114H6.66563V12.8317H8.82188C9.69375 12.8364 10.2422 13.1973 10.2422 14.1207ZM14.5969 12.7426C14.6531 11.8848 15.225 11.3504 16.0828 11.3504C16.9828 11.3504 17.4328 11.8754 17.5125 12.7426H14.5969ZM17.8828 9.05823H14.2359V8.17229H17.8828V9.05823ZM12.2203 14.2285C12.2203 13.0989 11.6859 12.1239 10.5797 11.8098C11.3859 11.4254 11.8078 10.9801 11.8078 10.0754C11.8078 8.28479 10.4719 7.84885 8.92969 7.84885H4.6875V16.8489H9.05156C10.6875 16.8395 12.2203 16.0567 12.2203 14.2285ZM16.1438 10.0004C18.1828 10.0004 19.3125 11.6082 19.3125 13.5348C19.3125 13.612 19.3081 13.6914 19.3038 13.7685C19.3018 13.8037 19.2999 13.8385 19.2984 13.8723H14.6016C14.6016 14.9129 15.15 15.527 16.2 15.527C16.7438 15.527 17.4422 15.2364 17.6156 14.6785H19.1953C18.7078 16.1739 17.7 16.8723 16.1438 16.8723C14.0906 16.8723 12.8109 15.4801 12.8109 13.4504C12.8109 11.491 14.1562 10.0004 16.1438 10.0004Z" fill="white"/>
          </svg>

          <svg class="d-none d-lg-block" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.25 1.88635H3.75C2.50736 1.88635 1.5 2.89371 1.5 4.13635V20.6364C1.5 21.879 2.50736 22.8864 3.75 22.8864H10.1836V15.7468H7.23047V12.3864H10.1836V9.8251C10.1836 6.91182 11.918 5.3026 14.5744 5.3026C15.8466 5.3026 17.1769 5.52948 17.1769 5.52948V8.38885H15.7111C14.2669 8.38885 13.8164 9.2851 13.8164 10.2043V12.3864H17.0405L16.5248 15.7468H13.8164V22.8864H20.25C21.4926 22.8864 22.5 21.879 22.5 20.6364V4.13635C22.5 2.89371 21.4926 1.88635 20.25 1.88635V1.88635Z" fill="white"/>
          </svg>

          @auth
            <form method="get" action="/search/" id="search">
              <div class="position-relative">
                <input type="text" name="search" class="text-white" placeholder="{{ __('Recherche ta chanson')}}" autocomplete="off">
                <input type="submit" value="">
              </div>
            </form>
          @endauth

        </div>
        <div class="col-12 col-lg-6 d-flex justify-content-end">
          <div>

            @if (App::isLocale('fr'))
              <a href="{{ route('index', 'en') }}" class="flag-icon flag-icon-gb mr-3"></a>
              @else
                <a href="{{ route('index', 'fr') }}" class="flag-icon flag-icon-fr mr-3"></a>
            @endif
          </div>
          <div>
            @guest
              <a class="connecter_link" href="{{ route('login', app()->getLocale()) }}">{{ __('Se connecter') }}</a>
          </div>
          <a class="btn btn-primary" href="{{ route('register', app()->getLocale()) }}">{{ __("S'inscrire") }} &#8594;</a>
            @else
              {{-- <a href="/{{app()->getLocale()}}/users/{{ Auth::user()->id }}">{{ Auth::user()->name }}</a> --}}
              <a class="text-white" href="{{ route('users', ["language" => app()->getLocale(), "id" => Auth::user()->id]) }}">{{ Auth::user()->name }}</a>
              <a class="deconnexion" href="{{ route('logout', app()->getLocale()) }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Déconnexion') }}
              </a>
              <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                  @csrf
              </form>
          </div>

          <a href="{{ route('songs.create', app()->getLocale()) }}" class="ml-0 ml-md-3 btn btn-primary">{{ __('Ajouter') }} &#8594;</a>
            @endguest
          </div>

        </div>
      </div>
    </header>

    <div class="container mt-5">

      <div id="pjax-container" class="my-3">
        @if (Session::has('toastr'))
           <script type="text/javascript">
            toastr.{{Session::get('toastr')['status']}}('{{Session::get('toastr')['message']}}')
          </script>
        @endif
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>

        @yield('contenu')
        <script type="text/javascript">
          // Modif DESCRIPTION
          $("#descriptionform button").hide();

          // Supprimer musique d'une playlist
          $('.boutonsuppr').click(function(e) {
              e.preventDefault();
              let id = $(this).attr('data-id');
              let idplaylist = $(this).attr('data-idplaylist');
              $('#suppr' + id).fadeOut();
              toastr.success('Votre changement a bien été effectué !')
              $.get("/update/" + idplaylist + "/" + id, '', function(data) {
              });
          });

          //Suppression d'une playlist
          $('.sup-playlist').on('click', function (e) {
            e.preventDefault();
            let idplaylist=$(this).attr('data-idplaylist');
            $.get( "/playlist/supprimer/"+idplaylist, '', function(data) {
            }).done(
                $.get( "/users", '', function(data) {
                    window.history.back()
                })
            );
          })

        </script>



      </div>
        @auth
            <div id="audiocontroller">
                @include('firstcontroller.audio')
            </div>
        @endauth

        <div class="dark-light">
          <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path></svg>
        </div>

    </div>


    {{-- <footer class="footer-section text-center">
      <div class="container">
        <div class="copyright">
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Ce site a été réalisé <i class="fa fa-heart-o" aria-hidden="true"></i> par Loubal70 & Nicolas Rosaye</a>

        </div>
      </div>
    </footer> --}}

    {{-- <script type="text/javascript">
      toastr.success('Have fun storming the castle!', 'Miracle Max Says')
    </script> --}}



    <script src="/js/divers.js"></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==" crossorigin="anonymous" />

    </body>
    </html>


  <footer id="audio">
    <div class="container-fluid mt-5 mb-2">
      <div class="row align-items-center">

        {{-- Left Component --}}

        <div class="col-lg-3">
          <div class="imgBx" style="background-image: url({{ isset($song) ? $song->image : '' }})">
            @isset($song)
              @if (Auth::user()->jeLike->contains($song->id)) {{-- Si chanson_id a été liké (présente dans la table like)--}}

                <a class="heart animationend" id="heart" href="/like/{{$song->id}}"></a>
              @else
                <a class="heart" id="heart" href="/like/{{$song->id}}"></a>
              @endif
            @endisset
          </div>
          <div class="text">
            <h6>Musique en cours :</h6>
            <span id="title"> </span>
          </div>
        </div>

        {{-- Center Component --}}

        <div class="col-lg-7" onselectstart="return false">
          <div class="">
            <i class="far fa-heart"></i>
            <i id="previous" class="fas fa-step-backward"></i>
            <i id="play" class="fas fa-play"></i>
            <i id="pause" class="fas fa-pause"></i>
            <i id="next" class="fas fa-step-forward"></i>
            <i id="repeat" class="fas fa-redo"></i>
            <audio id="music"
              @isset($song)
                src="/render/{{ $song->id }}/{{substr($song->url, 10)}}"
              @endisset

            >

            </audio>
          </div>
          <div class="mt-3">
            <small class="start-time" id="timer">00:00</small>
            <div id="slider"><div id="elapsed"></div></div>
            <small id="end-time">0:00</small>
          </div>
        </div>

        {{-- Right Component --}}

        <div class="col-lg-2">
          <svg x="0px" y="0px"
             width="32px" height="32px" viewBox="0 0 45.793 45.793" fill="#0073CF">
            <g>
              <circle cx="22.899" cy="12.692" r="2.524"/>
              <path d="M22.899,26.661c-2.893,0-5.245,2.354-5.245,5.245c0,2.893,2.353,5.244,5.245,5.244s5.246-2.353,5.246-5.244
                C28.145,29.016,25.791,26.661,22.899,26.661z"/>
              <path d="M30.701,0H15.093c-4.647,0-8.415,3.768-8.415,8.414v28.965c0,4.646,3.768,8.414,8.415,8.414H30.7
                c4.647,0,8.415-3.768,8.415-8.414V8.414C39.116,3.768,35.348,0,30.701,0z M22.899,7.182c3.042,0,5.511,2.467,5.511,5.511
                c0,3.043-2.469,5.511-5.511,5.511c-3.044,0-5.511-2.468-5.511-5.511C17.388,9.648,19.855,7.182,22.899,7.182z M22.899,42.13
                c-5.646,0-10.223-4.577-10.223-10.224s4.576-10.223,10.223-10.223c5.646,0,10.223,4.577,10.223,10.223S28.544,42.13,22.899,42.13z
                "/>
            </g>
          </svg>
          <progress value="0" max="1"></progress>

        </div>


      </div>
    </div>

  </footer>
  <script src="/js/players.js">

  </script>

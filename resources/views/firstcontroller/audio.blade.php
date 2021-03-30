
  <footer id="audio">
    <div class="container-fluid mt-5 mb-2">
      <div class="row align-items-center">

        {{-- Left Component --}}

        <div class="col-lg-3">
          <div class="imgBx" style="background-image: url({{ isset($song) ? $song->image : '' }})">
            <div id="divlike">
                <a class="" id="heart" href="#"></a>
            </div>
          </div>
          <div class="text">
            <h6>{{ __('Musique en cours :') }}</h6>
            <span id="title"> </span>
          </div>
        </div>

        {{-- Center Component --}}

        <div class="col-lg-7" onselectstart="return false">
          <div class="">
            <i class="fas fa-random"></i>
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
          <i class="fas fa-volume-up volume"></i>
        </div>


      </div>
    </div>

  </footer>
  <script src="/js/players.js">

  </script>

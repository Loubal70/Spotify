<table>
  <thead>
    <tr>
      <td class="text-white">#</td>
      <td></td>
      <td class="text-white">TITRE</td>
    </tr>
  </thead>
  <tbody>
    @php
      $nb = 0;
    @endphp
    @foreach($songs as $s)
        <tr>
          {{-- <a href="#" data-id="{{$s->id}}" data-nb='{{ $nb }}'  data-file="{{$s->url}}" data-titre="{{ $s->title }}" data-img="{{ $s->image }}" class="song"> --}}
              <td>{{ $nb++ }}</td>
              <td>
                <a data-id="{{$s->id}}" data-nb='{{ $nb }}' data-file ="/render/{{ $s->id }}/{{substr($s->url, 10)}}" data-titre="{{ $s->title }}" data-img="{{ $s->image }}" class="song">
                  <img src="{{ $s->image }}" alt="{{ $s->title }}" class="img-fluid" style="width: 30px; height: 30px; border-radius: 5px; object-fit: cover;">
                </a>
              </td>
              <td>
                <a data-id="{{$s->id}}" data-nb='{{ $nb }}' data-file ="/render/{{ $s->id }}/{{substr($s->url, 10)}}" data-titre="{{ $s->title }}" data-img="{{ $s->image }}" class="song">
                  {{ $s->title }}
                </a>
              </td>
            <td>
              <span>


                <i class="fas fa-plus" data-id="{{$s->id}}" data-bs-toggle="modal" data-bs-target="#modalPlaylist-{{$s->id}}"></i>
              </span>

            </td>

              {{-- {{ $s->title }}

            ajouté par <a href="/users/{{ $s->user->id }}">{{ $s->user->name }}</a>
            aimé par {{$s->votes}} personnes</li> --}}
        </tr>
        <!-- Modal -->
        <div class="modal fade" id="modalPlaylist-{{$s->id}}" tabindex="-1" aria-labelledby="modalPlaylist" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Dans quelle playlist va-t-on ajouter cette musique ?') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                @auth
                @foreach($playlists as $p)
                    @if(Auth::user()->playlist->contains($p->id))
                        @if($p->aLaChanson->contains($s->id))
                            {{-- La musique est déjà dans le playlist --}}
                        @else
                            <a href="#" onclick="addPlaylist({{$s->id}}, {{$p->id}});" data-idplaylist="{{$p->id}}" data-id="{{$s->id}}" data-status="necontientpas">
                                <p id="p{{$p->id}}-{{$s->id}}">{{$p->nom}}<i id="check{{$p->id}}-{{$s->id}}" class="fas fa-check invisible"></i></p>
                            </a>
                        @endif
                    @endif
                @endforeach
                  <a href="{{ route('newplaylist', ["language" => app()->getLocale(), "id" => $s->id]) }}"><p>{{ __('Ajouter à une nouvelle playlist') }}</p></a>
                @endauth
                @guest
                    <a href="{{ route('login', app()->getLocale()) }}" data-pjax><p>{{ __('Connectez-vous pour ajouter cette chanson à une playlist') }}</p></a>
                @endguest
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Fermer") }}</button>
              </div>
            </div>
          </div>
        </div>
    @endforeach
  </tbody>
</table>

<script type="text/javascript">

function addPlaylist(id, idplaylist){
   let clic=$(this);
   $.get( "/update/"+idplaylist+"/"+id, '', function(data) {
       $('#p'+idplaylist+'-'+id).toggleClass('danslaplaylist');
       $('#check'+idplaylist+'-'+id).toggleClass('invisible');
       if(status==='contient'){
           clic.attr('data-status','necontientpas');
       }else{
           clic.attr('data-status','contient');
       }
       toastr.success("{{ __('Changement effectué avec succès') }}")
   });
}
</script>

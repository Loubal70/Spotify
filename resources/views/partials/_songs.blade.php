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
              <span
                href="#"
                data-toggle="popover"
                title="Choisissez votre playlist :"
                data-content=
                @auth
                @foreach($playlists as $p)
                    @if(Auth::user()->playlist->contains($p->id))
                        @if($p->aLaChanson->contains($s->id))
                            '<a class="majplaylist" data-idplaylist="{{$p->id}}" data-id="{{$s->id}}" data-status="contient">
                                <p id="p{{$p->id}}-{{$s->id}}" class="playlist_back danslaplaylist" data-idplaylist="{{$p->id}}" data-id="{{$s->id}}">{{$p->nom}}<i id="check{{$p->id}}-{{$s->id}}" class="fas fa-check"></i></p>
                            </a>
                        @else
                            '<a href="#" onclick="addPlaylist({{$s->id}}, {{$p->id}});" data-idplaylist="{{$p->id}}" data-id="{{$s->id}}" data-status="necontientpas">
                                <p id="p{{$p->id}}-{{$s->id}}" class="text-dark">{{$p->nom}}<i id="check{{$p->id}}-{{$s->id}}" class="fas fa-check invisible"></i></p>
                            </a>
                        @endif
                    @endif
                @endforeach
                  <a href="{{ route('newplaylist', ["language" => app()->getLocale(), "id" => $s->id]) }}"><p class="text-dark">{{ __('Ajouter à une nouvelle playlist') }}</p></a>
                @endauth
                @guest
                    '<a href="{{ route('login', app()->getLocale()) }}" data-pjax><p>{{ __('Connectez-vous pour ajouter cette chanson à une playlist') }}</p></a>'
                @endguest

                <i class="fas fa-plus"></i>
              </span>

            </td>

              {{-- {{ $s->title }}

            ajouté par <a href="/users/{{ $s->user->id }}">{{ $s->user->name }}</a>
            aimé par {{$s->votes}} personnes</li> --}}
        </tr>
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
   });
}
</script>

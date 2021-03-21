@extends("templates.general")

@section('contenu')
  <div>
      <div>
          <div class="titre d-flex align-items-center">
            <h2 class="mb-0">Musiques de : {{$playlist->nom}}</h2>
            <a class="sup-playlist ml-3" data-idplaylist="{{$playlist->id}}"><i class="fas fa-trash-alt sup-playlist"></i></a>
          </div>
      </div>

  </div>
  <table>
    <thead>
      <tr>
        <td>#</td>
        <td></td>
        <td>TITRE</td>
      </tr>
    </thead>
    <tbody>
        @php
          $nbchanson = 0;
        @endphp
        @foreach($chansons as $c)
            @if($playlist->aLaChanson->contains($c->id))
              @php
                echo "<tr><td>".$nbchanson++."</td>";
              @endphp
              <td>
                <a data-id="{{$c->id}}" data-nb='{{ $nbchanson }}' data-file ="/render/{{ $c->id }}/{{substr($c->url, 10)}}" data-titre="{{ $c->title }}" data-img="{{ $c->image }}" class="song">
                  <img src="{{ $c->image }}" alt="{{ $c->title }}" class="img-fluid" style="width: 30px; height: 30px; border-radius: 5px; object-fit: cover;">
                </a>
              </td>
              <td>
                <a data-id="{{$c->id}}" data-nb='{{ $nbchanson }}' data-file ="/render/{{ $c->id }}/{{substr($c->url, 10)}}" data-titre="{{ $c->title }}" data-img="{{ $c->image }}" class="song">
                  {{ $c->title }}
                </a>
              </td>
              <td>
                <a class="boutonsuppr" href="/playlist/update/{{$playlist->id}}/{{$c->id}}">x</a>
              </td>
            @endif
        @endforeach
        @if ($nbchanson === 0)
          <p>Votre playlist est vide pour le moment...</p>
        @endif

      @endsection

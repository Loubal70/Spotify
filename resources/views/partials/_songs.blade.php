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
      $nb = 0;
    @endphp
    @foreach($songs as $s)
        <tr data-id="{{$s->id}}" data-nb='{{ $nb }}'  data-file="{{$s->url}}" data-titre="{{ $s->title }}" data-img="{{ $s->image }}" class="song">
          {{-- <a href="#" data-id="{{$s->id}}" data-nb='{{ $nb }}'  data-file="{{$s->url}}" data-titre="{{ $s->title }}" data-img="{{ $s->image }}" class="song"> --}}
            <td>{{ $nb++ }}</td>
            <td>
                <img src="{{ $s->image }}" alt="{{ $s->title }}" class="img-fluid" style="width: 30px; height: 30px; border-radius: 5px; object-fit: cover;">
            </td>
            <td>{{ $s->title }}</td>

              {{-- {{ $s->title }}

            ajouté par <a href="/users/{{ $s->user->id }}">{{ $s->user->name }}</a>
            aimé par {{$s->votes}} personnes</li> --}}
        </tr>
    @endforeach
  </tbody>
</table>

<ul>
  @foreach($songs as $s)
    <li><a href="#" data-file="{{$s->url}}" data-titre="{{ $s->title }}" data-img="{{ $s->image }}" class="song">{{ $s->title }}</a>
      ajouté par <a href="/users/{{ $s->user->id }}">{{ $s->user->name }}</a>
      aimé par {{$s->votes}} personnes</li>
  @endforeach
</ul>

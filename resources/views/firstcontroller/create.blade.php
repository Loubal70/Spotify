@extends("templates.general")

@section('contenu')

<h1>Nouvelle chanson</h1>

{{-- <pre>{{print_r(Session::all())}}</pre> --}}

  @include('partials._errors')

  <form action="/songs" method="post" enctype="multipart/form-data">
    {{-- Permet de faire du post Obligatoire dans le from et en meta donnée--}}
    @csrf
    <input type="text" name="title" placeholder="Titre de la chanson" value="{{old('title')}}">
    <br>
    <input type="file" name="song" placeholder="URL de la chanson">
    <br>
    <input type="submit" name="submit" value="Envoyer">
  </form>

@endsection

@extends("templates.general")
@section('contenu')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-body">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <form action="/playlist/create" method="POST" enctype="multipart/form-data" data-pjax>
            <h1>{{ __('Créer une playlist') }}</h1>
              @csrf
              <div class="form-group row align-items-center">
                  <label for="nom" class="col-md-4 col-form-label text-md-right text-white">Nom de la playlist :</label>
                  <div class="col-md-6">
                    <input type="text" name="nom" placeholder="Titre de la playlist" value="{{old('nom')}}" class="form-control " required>
                  </div>
              </div>
              <div class="form-group row align-items-center">
                <label class="col-md-4 col-form-label text-md-right text-white" for="imgMusiq">Image de votre playlist :</label>
                <div class="col-md-6">
                  <input type="file" id="imgMusiq" name="imgMusiq" value="{{old('url')}}" class="form-control" required>
                </div>
              </div>

              <input type="submit" class="btn btn-primary" value="Envoyer">

              {{-- <label for="" class="label-file col"><p>Importer votre image <br>pour votre playlist</p><img id="apercuimg" class="fit-file" src="/img/upload.png"
                                                                                                                   alt="upload"></label>
              <input type="hidden" name="idchanson" value="{{$idchanson ?? '0'}}">
              <input type="file" id="imgMusiq" name="imgMusiq" value="{{old('url')}}" class="input_file imgapercu" required> --}}

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

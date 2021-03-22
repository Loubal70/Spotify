@extends("templates.general")

@section('contenu')



{{-- <pre>{{print_r(Session::all())}}</pre> --}}

  @include('partials._errors')



  <div class="card">
      <div class="card-body">
        <form action="/songs" method="post" enctype="multipart/form-data" data-pjax>
          {{-- Permet de faire du post Obligatoire dans le from et en meta donnée--}}
          @csrf
          <h1>{{ __('Nouvelle chanson') }}</h1>
          <div class="form-group row align-items-center">
              <label for="title" class="col-md-4 col-form-label text-md-right text-white">{{ __('Titre de la chanson') }} :</label>
              <div class="col-md-6">
                <input type="text" name="title" class="form-control" placeholder="{{ __('Exemple') }} : Notice Me" value="{{old('title')}}">
              </div>
          </div>
          <div class="form-group row align-items-center">
            <label class="col-md-4 col-form-label text-md-right text-white" for="musique">{{ __('Télécharger votre son') }} :</label>
            <div class="col-md-6">
              <input type="file" name="song" class="form-control" id="musique" />
            </div>
          </div>
          <div class="form-group row align-items-center">
            <label class="col-md-4 col-form-label text-md-right text-white" for="image">{{ __('Couverture Album') }} :</label>
            <div class="col-md-6">
              <input type="file" name="image" class="form-control" id="image" />
            </div>
          </div>
          <br>
          <input type="submit" name="submit" class="btn btn-primary d-block ml-auto" value="{{ __('Envoyer') }}">
        </form>

      </div>
  </div>

@endsection

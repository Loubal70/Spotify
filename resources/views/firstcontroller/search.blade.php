@extends('templates.general')

@section('contenu')
    <h1 class="text-white">{{ __('Recherche')}} {{$search}}</h1>

    <h4 class="text-white">{{ __('Utilisateurs')}}</h4>

    <table>
      <tbody>
        @foreach ($users as $u)
          <tr class="my-2">
            <td><a class="text-white" href="{{ route('users', ["language" => app()->getLocale(), "id" => $u->id]) }}">{{$u->name}}</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <h4 class="text-white">{{ __('Chansons')}}</h4>
    @include('partials._songs')


@endsection

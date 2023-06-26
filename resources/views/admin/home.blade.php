@extends('layouts.app')

@section('content')

<div class="container">
  <h2 class="fs-4 text-secondary my-4">
    HOME dashboard
  </h2>

  <p>Numero Progetti presenti: {{ $n_projects }}</p>

  <h5>Ultimo Progetto</h5>

  {{-- TODO: abbellire la home con lo show dell'ultimo progetto --}}

  <div>
    <h6>{{ $last_project->name }}</h6>
  </div>

</div>

@endsection

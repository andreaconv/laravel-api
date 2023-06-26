@extends('layouts.app')

@section('content')

<div class="container">

  <h2 class="fs-4 text-secondary my-4">
    Elenco tipologie
  </h2>

  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Numero Progetti</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($types as $type)

        <tr>
          <td>{{ $type->name }}</td>
          <td>{{ count($type->projects) }}</td>
        </tr>

      @endforeach


    </tbody>
  </table>



</div>

@endsection

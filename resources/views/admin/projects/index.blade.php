@extends('layouts.app')

@section('content')

<div class="container">

  <h2 class="fs-4 text-secondary my-4">
    Project list
  </h2>

  @if (session('deleted'))
    <div class="alert alert-success" role="alert">
      {{ session('deleted') }}
    </div>
  @endif

  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th scope="col"><a href="{{ route('admin.orderby', ['direction' => $direction]) }}" class="text-white">ID</a></th>
        <th scope="col">Nome</th>
        <th scope="col">Tipo</th>
        <th scope="col">Categoria</th>
        <th scope="col">Tecnologia</th>
        <th scope="col">Data di creazione</th>
        <th id="actions" scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($projects as $project)
        <tr>
          <th scope="row">{{ $project->id }}</th>

          <td>{{ $project->name }}</td>

          <td>{{-- il punto interrogativo è il Null-safe operator "?"  --}}
            <span class="badge text-bg-{{ $project->type?->color }}">{{ $project->type?->name }}</span>
          </td>

          <td>{{ $project->category }}</td>

          <td>
            @forelse ($project->technologies as $tec)
              <span class="badge text-bg-light">{{ $tec->name }}</span>
            @empty
              <span>- no tec -</span>
            @endforelse
          </td>


          @php $date = date_create($project->date_creation) @endphp
          <td>{{ date_format($date, 'd/m/Y') }}</td>

          <td >
            <a href="{{ route('admin.project.show', $project) }}" class="btn btn-success" title="Visualizza"><i class="fa-regular fa-eye"></i></a>
            <a href="{{ route('admin.project.edit', $project) }}" class="btn btn-warning" title="Modifica"><i class="fa-solid fa-pencil"></i></a>
            @include('admin.partials.form-delete')
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div>{{ $projects->links() }}</div>

</div>

@endsection

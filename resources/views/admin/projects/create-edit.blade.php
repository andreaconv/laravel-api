@extends('layouts.app')

@section('content')

<div class="container">

  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <h1>{{ $title }}</h1>

  <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)

    <div class="row">

      <div class="mb-3 col-9">
        <label for="name" class="form-label">Nome Progetto</label>
        <input
          type="text"
          class="form-control @error('name') is-invalid @enderror"
          value="{{ old('name', $project?->name) }}"
          placeholder="Nome Progetto"
          id="name"
          name="name">

          @error('name')
            <p class="text-danger">{{ $message }}</p>
          @enderror
      </div>

      <div class="mb-3 col-3">
        <label for="date_creation" class="form-label">Data di Creazione</label>
        <input
          type="date"
          class="form-control"
          name="date_creation"
          id="date_creation"
          value="{{ old('date_creation', $project?->date_creation) }}"
          placeholder="Data di creazione">
      </div>

    </div>

    <div class="row">

      <div class="mb-3 col-3">
        <label for="category" class="form-label">Tipologia</label>
        <select class="form-select" name="type_id">
          <option value="">Selezionare una tipologia</option>

          @foreach ($types as $type)

            <option
              value="{{ $type->id }}"
              @if ($type->id == old('type_id', $project?->type?->id)) selected @endif >
              {{ $type->name }}
            </option>

          @endforeach
        </select>
      </div>

      <div class="mb-3 col-9">
        <label for="category" class="form-label">Categoria</label>
        <input
          type="text"
          class="form-control @error('category') is-invalid @enderror"
          value="{{ old('category', $project?->category) }}"
          placeholder="Categoria"
          id="category"
          name="category">

          @error('category')
            <p class="text-danger">{{ $message }}</p>
          @enderror
      </div>

    </div>

    <div class="row mb-3">
      <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

        @foreach ($technologies as $tec)

          <input
            type="checkbox"
            class="btn-check"
            id="tec{{ $loop->iteration }}"
            value="{{ $tec->id }}"
            name="technologies[]"

            @if (!$errors->any() && $project?->technologies->contains($tec))
              checked
            @elseif ($errors->any() && in_array($tec->id, old('technologies', [])))
              checked
            @endif

            autocomplete="off">
          <label class="btn btn-outline-dark" for="tec{{ $loop->iteration }}">{{ $tec->name }}</label>

        @endforeach

      </div>
    </div>

    <div class="row">

      <div class="mb-3 col-9">
        <label for="image" class="form-label">Immagine</label>
        <input
          onchange="showimage(event)"
          type="file"
          class="form-control"
          name="image"
          id="image">
      </div>
      <div class="col-3">
        <img class="image w-100" id="prev-image" src="{{ asset('storage/' . $project?->image_path) }}" onerror="this.src='/img/placeholder.jpg'">
        {{-- FIXME: alternativa per il percoso dell'immagine placeholder sarebbe stata quella di salvare il percorso in una variabile e passarla dinamicamente coma abbiamo fatto per il titolo e gli altri --}}
        {{-- <img class="image w-100" id="prev-image" src="{{ $image }}"> --}}
      </div>
    </div>


      <div class="mb-3">
        <label for="descrizione" class="form-label">Descrizione</label>
        <textarea
          name="description"
          id="description"
          {{-- FIXME: non accetta le classi da quando ho inserito il CK EDITOR --}}
          class="form-control @error('category') is-invalid @enderror"
          placeholder="Descrizione"
          cols="30"
          rows="10">{{ old('description', $project?->description) }}</textarea>

          @error('description')
            <p class="text-danger">{{ $message }}</p>
          @enderror
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>

    </form>

</div>

<script>
  ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
      console.error( error );
    });

    function showimage(event){
      const tagImage = document.getElementById('prev-image');
      tagImage.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

@endsection

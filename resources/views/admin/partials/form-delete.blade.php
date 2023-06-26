{{-- <form action="{{ route('admin.project.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Confermi l\'eliminazione del progetto: {{ $project->name }} ?')">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn btn-danger" title="Elimina">Elimina</button>
</form> --}}

<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
  <i class="fa-solid fa-trash-can"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Confermi l'eliminazione del progetto: "{{ $project->name }}"
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

        <form action="{{ route('admin.project.destroy', $project) }}" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" title="Elimina">Elimina</button>
          </form>
      </div>
    </div>
  </div>
</div>

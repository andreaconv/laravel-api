<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $direction = 'asc';
    $projects = Project::orderBy('id', $direction)->paginate(10);
    return view('admin.projects.index', compact('projects', 'direction'));
  }

  public function orderby($direction){
    $direction = $direction === 'asc' ? 'desc' : 'asc';
    $projects = Project::orderBy('id', $direction)->paginate(10);
    return view('admin.projects.index', compact('projects', 'direction'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $types = Type::all();
    $technologies = Technology::all();
    $title = 'Creazione di un nuovo Progetto';
    $method = 'POST';
    $route = route('admin.project.store');
    $project = null;
    // $image = '/img/placeholder.jpg';
    return view('admin.projects.create-edit', compact('title', 'method', 'route', 'project', 'types', 'technologies'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProjectRequest $request)
  {
    $form_data = $request->all();
    $form_data['slug'] = Project::generateSlug($form_data['name']);

    // verifico se è stata caricata un'immagine
    // FIXME: alternativa della condizione if($request->hasFile('image'))
    if(array_key_exists('image', $form_data)){

      // prima di salvare l'immagine salvo il nome
      $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
      // salvo l'immagine nella cartella uploads e in $form_data['image_path'] salvo il percorso
      $form_data['image_path'] = Storage::put('uploads/', $form_data['image']);
    }

    // $new_project = new Project();
    // $new_project->fill($form_data);
    // $new_project->save();
    // FIXME: soluzione short crea fa il fill e il save
    $new_project = Project::create($form_data);

    if(array_key_exists('technologies', $form_data)){
      // attacco al progetto appena creato l'array delle tecnologie proveniente dal form
      $new_project->technologies()->attach($form_data['technologies']);
    }

    return redirect()->route('admin.project.show', $new_project);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Project $project)
  {
    $date = date_create($project->date_creation);
    $data_formatted = date_format($date, 'd/m/Y');
    return view('admin.projects.show', compact('project', 'data_formatted'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Project $project)
  {
    $types = Type::all();
    $technologies = Technology::all();
    $title = 'Modifica del progetto: ' . $project->name;
    $method = 'PUT';
    $route = route('admin.project.update', $project);
    // $image = 'asset(storage/ . $project->image_path)';
    return view('admin.projects.create-edit', compact('title', 'method', 'route', 'project', 'types', 'technologies'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(ProjectRequest $request, Project $project)
  {
    $form_data = $request->all();

    if($form_data['name'] !== $project->name){
      $form_data['slug'] = Project::generateSlug($form_data['name']);
    }else{
      $form_data['slug'] = $project->slug;
    }

    // FIXME:------- blocco di codice simile nello store---------
    // verifico se è stata caricata un'immagine
    if(array_key_exists('image', $form_data)){
      // se l'img esiste vuol dire che ne ho caricata una nuova e quindi elimino quella vecchia
      if($project->image_path){
        Storage::disk('public')->delete($project->image_path);
      }

      // prima di salvare l'immagine salvo il nome
      $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
      // salvo l'immagine nella cartella uploads e in $form_data['image_path'] salvo il percorso
      $form_data['image_path'] = Storage::put('uploads/', $form_data['image']);
    }
    // FIXME:------- blocco di codice simile nello store---------

    $project->update($form_data);

    return redirect()->route('admin.project.show', $project);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Project $project)
  {

    // se il poogetto da eliminare contine un' immagine la devo cancellare dalla cartella
    if($project->image_path){
      Storage::disk('public')->delete($project->image_path);
    }

    $project->delete();

    return redirect()->route('admin.project.index')->with('deleted', "Il progetto $project->name è stato eliminato correttamente");
  }
}

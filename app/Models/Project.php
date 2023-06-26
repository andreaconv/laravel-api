<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model {

  use HasFactory;

  protected $fillable = [
    'name',
    'type_id',
    'slug',
    'description',
    'category',
    'image_path',
    'image_original_name',
    'date_creation'
  ];

  // relazione con la tabella Types
  // nome della tabella in camelCase al singolare perchè ogni progetto ha un solo type
  // "appartengo a un type"
  public function type(){
    return $this->belongsTo(Type::class);
  }

  public function technologies(){
    return $this->belongsToMany(Technology::class);
  }

  public static function generateSlug($str){

    $slug = Str::slug($str, '-');
    $original_slug = $slug;

    // Controllo di univicità
    /*
      1. controllo se lo slug è presente
      2. se non è presente ritorno slo slug generato
      3. se è presente aggiungo un contatore
      4. se ancho col contatore è presente aggiungo +1 al contatore fino a trovare uno slug univoco
    */

    $slug_exixts = Project::where('slug', $slug)->first();
    $c = 1;
    while($slug_exixts){
      $slug = $original_slug . '-' . $c;
      $slug_exixts = Project::where('slug', $slug)->first();
      $c++;
    }

    return $slug;
  }
}

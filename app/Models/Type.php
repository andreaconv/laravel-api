<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
  use HasFactory;

  // relazione con la tabella projects
  //  ogni type ha tanti progetti quindi la funzione è al plurale
  //  "ho tanti progetti"
  public function projects(){
    return $this->hasMany(Project::class);
  }
}

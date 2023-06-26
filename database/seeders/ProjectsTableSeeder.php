<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use App\Models\Type;


class ProjectsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(Faker $faker)
  {
    for ($i=0; $i < 25 ; $i++) {

      $new_project = new Project();

      // prendo un elemento random dalla tabella Type, prendi il primo elemento e di quello passami l'ID e lo salva nella variabile $type_id
      $new_project->type_id = Type::inRandomOrder()->first()->id;
      $new_project->name = $faker->words(3, true);
      $new_project->slug = Project::generateSlug($new_project->name);
      $new_project->description = $faker->text();
      $new_project->category = $faker->words(2, true);
      $new_project->date_creation = $faker->date('Y_m_d');

      // dump($new_project);
      $new_project->save();
  }
  }
}

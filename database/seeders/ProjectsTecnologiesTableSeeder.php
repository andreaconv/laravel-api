<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;


class ProjectsTecnologiesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    for ($i=0; $i < 10; $i++) {
      // estraggo un project random

      $project = Project::inRandomOrder()->first();

      // estraggo l'ID di una tecnologia random
      $tec_id = Technology::inRandomOrder()->first()->id;

      $project->technologies()->attach($tec_id);

    }
  }
}

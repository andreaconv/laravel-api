<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      // l'ordine dei seeder è importante perchè prima  mi popola la tabella che andrà a popolare la colonna in relazione
      TypeTableSeeder::class,
      TechnologiesTableSeeder::class,
      ProjectsTableSeeder::class // in produzione commentare questo seeder
  ]);
  }
}

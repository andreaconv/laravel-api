<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $types = [
      'HTML'       => 'danger',
      'CSS'        => 'primary',
      'JavaScript' => 'warning',
      'VUE'        => 'success',
      'VITE'       => 'info',
      'PHP'        => 'violet',
      'LARAVEL'    => 'secondary'
    ];

    foreach($types as $type => $color){
      $new_type = new Type();
      $new_type->name = $type;
      $new_type->slug = Str::slug($type, '-');
      $new_type->color = $color;
      $new_type->save();
    }

  }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('projects', function (Blueprint $table) {
      $table->string('image_path')->nullable()->after('category');
      $table->string('image_original_name')->nullable()->after('category');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('projects', function (Blueprint $table) {
      $table->dropColumn('image_path');
      $table->dropColumn('image_original_name');
    });
  }
};

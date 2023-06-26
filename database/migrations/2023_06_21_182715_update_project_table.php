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

      // 1. creo la colonna delle Foreign Key
        $table->unsignedBigInteger('type_id')->nullable()->after('id');

        // 2. assegno la Foreign Key alla colonna creata
        $table->foreign('type_id')
              ->references('id')
              ->on('types')
              ->onDelete('set null');
              // se viene eliminato un type i post in relazione non cengono persi e avranno type_id=null
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

      // 1. elimino la Foreign Key
      $table->dropForeign(['type_id']);

      // 2. elimino la colonna
      $table->dropColumn('type_id');

    });
  }
};

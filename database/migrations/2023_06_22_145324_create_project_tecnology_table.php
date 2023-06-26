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
        Schema::create('project_technology', function (Blueprint $table) {

          // relazione con la tabella projects
          // creo la colonna
          $table->unsignedBigInteger('project_id');
          // creo la FK
          $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->cascadeOnDelete(); //all'eliminazione di un project viene eliminata anche la relazione con la tecnologia

          // relazione con la tabella tecnologies
          // creo la colonna
          $table->unsignedBigInteger('technology_id');
          // creo la FK
          $table->foreign('technology_id')
                ->references('id')
                ->on('technologies')
                ->cascadeOnDelete(); //all'eliminazione di una tecnologia viene eliminata anche la relazione con un project
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_technology');
    }
};

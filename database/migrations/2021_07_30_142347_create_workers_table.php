<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();;
            $table->string('prenom');
            $table->string('specialite');
            $table->integer('exp');
            $table->string('tel');
            $table->float('salaire');
            $table->binary('travail');
            $table->string('desc');
            $table->binary('img');
            $table->string('lieu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
}

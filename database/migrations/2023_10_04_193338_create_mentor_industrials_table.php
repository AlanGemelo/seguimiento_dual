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
        Schema::create('mentor_industrials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->string('name');
            $table->string('puesto'); // Nuevo campo
            $table->foreignId('empresa_id')->constrained('empresas');
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
        Schema::dropIfExists('mentor_industrials');
    }
};

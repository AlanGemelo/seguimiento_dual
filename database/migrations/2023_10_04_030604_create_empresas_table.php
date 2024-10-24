<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->text('direccion');
            $table->string('telefono', 10);
            $table->date('inicio_conv');
            $table->date('fin_conv');
            $table->text('ine')->nullable();
            $table->foreignId('direccion_id')->constrained('direccion_carreras');
            $table->text('convenioA')->nullable();
            $table->text('convenioMA')->nullable();

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
        Schema::dropIfExists('empresas');
    }
};

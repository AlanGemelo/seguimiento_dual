<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexo21Table extends Migration
{
    public function up()
    {
        Schema::create('anexo2_1', function (Blueprint $table) {
            $table->id();
            $table->string('unidad_economica');
            $table->string('periodo');
            $table->date('fecha');
            $table->longText('seccion_1');
            $table->longText('seccion_2');
            $table->longText('seccion_3');
            $table->string('aplicador');
            $table->foreignId('autorizo')->constrained('users');
            $table->float('nivel_vulnerabilidad')->nullable();
            $table->string('resultado_definitivo')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('anexo_2_1');
    }
}

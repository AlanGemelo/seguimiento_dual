<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexo11Table extends Migration
{
    public function up()
    {
        Schema::create('anexo_1_1', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institucion_educativa')->default('Universidad Tecnológica del Valle de Toluca');
            $table->foreignId('programa_educativo_id')->constrained('carreras');
            $table->date('fecha_elaboracion')->default(now());
            $table->foreignId('responsable_programa_id')->constrained('users');
            $table->foreignId('responsable_academico_id')->constrained('directors');
            $table->longText('competencias'); // Cambiado a LONGTEXT
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anexo_1_1');
    }
}

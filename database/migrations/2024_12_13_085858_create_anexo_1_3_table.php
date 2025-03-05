<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexo13Table extends Migration
{
    public function up()
    {
        Schema::create('anexo_1_3', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_realizacion');
            $table->string('lugar');
            $table->string('razon_social');
            $table->string('rfc');
            $table->string('domicilio');
            $table->string('nombre_representante');
            $table->string('cargo_representante');
            $table->string('telefono');
            $table->string('correo_electronico');
            $table->string('actividad_economica');
            $table->integer('numero_empleados');
            $table->boolean('participacion_anterior');
            $table->text('motivo_no_participacion')->nullable();
            $table->boolean('interes_participar');
            $table->integer('numero_estudiantes')->nullable();
            $table->text('motivo_no_interes')->nullable();
            $table->boolean('informacion_clara');
            $table->text('comentarios_adicionales')->nullable();
            $table->foreignId('quien_elaboro_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anexo_1_3');
    }
}

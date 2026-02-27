<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->text('direccion');
            $table->string('ext_telefonica', 10)->nullable();
            $table->string('telefono', 10);
            $table->date('inicio_conv');
            $table->date('fin_conv');
            $table->text('ine')->nullable();
            $table->foreignId('direccion_id')->constrained('direccion_carreras');
            $table->text('convenioA')->nullable();
            $table->text('convenioMA')->nullable();
            // Nuevos campos
            $table->string('unidad_economica')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('nombre_representante')->nullable();
            $table->string('cargo_representante')->nullable();
            $table->string('actividad_economica')->nullable();
            $table->string('tamano_ue')->nullable();
            $table->string('folio')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: candidata, 1: activa, 2: baja temporal, 3: eliminada'); // 0 = no aceptada, 1 = aceptada
            $table->string('motivo_baja')->nullable(); // Motivo de la baja (ej: "Cierre definitivo")
            $table->date('fecha_baja')->nullable(); // Fecha en que se dio de baja
            $table->text('comentarios_baja')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
};

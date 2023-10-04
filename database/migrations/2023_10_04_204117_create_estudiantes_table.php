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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigInteger('matricula')->primary()->unique();
            $table->string('name');
            $table->string('curp');
            $table->date('fecha_na');
            $table->boolean('activo')->default(true);
            $table->string('cuatrimestre');
            $table->text('nombre_proyecto');
            $table->date('inicio_dual');
            $table->date('fin_dual');
            $table->boolean('beca')->default(false);
            $table->text('ine')->nullable();
            $table->text('evaluacion_form')->nullable();
            $table->text('minutas')->nullable();
            $table->text('carta_acp')->nullable();
            $table->text('plan_form')->nullable();
            $table->text('historial_academico')->nullable();
            $table->text('perfil_ingles')->nullable();
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('academico_id')->constrained('users');
            $table->foreignId('asesorin_id')->constrained('mentor_industrials');
            $table->foreignId('carrera_id')->constrained('carreras');
            $table->softDeletes();
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
        Schema::dropIfExists('estudiantes');
    }
};

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
            $table->string('name')->default(NULL);
            $table->string('curp')->default(NULL);
            $table->date('fecha_na');
            $table->boolean('activo')->default(true);
            $table->string('cuatrimestre');
            $table->text('nombre_proyecto')->default(NULL);
            $table->date('inicio_dual')->default(NULL);
            $table->date('fin_dual')->default(NULL);
            $table->integer('status')->default('0');
            $table->integer('tipoBeca')->default('0');
            $table->integer('estado_registro')->default('0');
            $table->boolean('beca')->default(false);
            $table->text('ine')->nullable();
            $table->text('evaluacion_form')->nullable()->default(NULL);
            $table->text('minutas')->nullable()->default(NULL);
            $table->text('carta_acp')->nullable()->default(NULL);
            $table->text('formatoA')->nullable()->default(NULL);
            $table->text('formatoB')->nullable()->default(NULL);
            $table->text('formatoC')->nullable()->default(NULL);
            $table->text('plan_form')->nullable()->default(NULL);
            $table->text('historial_academico')->nullable()->default(NULL);
            $table->text('perfil_ingles')->nullable()->default(NULL);
            $table->foreignId('empresa_id')->constrained('empresas')->default(NULL);
            $table->foreignId('academico_id')->constrained('users')->default(NULL);
            $table->foreignId('asesorin_id')->constrained('mentor_industrials')->default(NULL);
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

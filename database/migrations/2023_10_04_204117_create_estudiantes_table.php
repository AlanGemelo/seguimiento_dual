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
            $table->String('apellidoP');
            $table->String('apellidoM');
            $table->string('curp')->default(NULL);
            $table->date('fecha_na');
            $table->boolean('activo')->default(false);
            $table->string('cuatrimestre');

            $table->text('nombre_proyecto')->nullable()->default(NULL);
            $table->date('inicio_dual')->nullable()->default(NULL);
            $table->date('inicio')->nullable()->default(NULL);
            $table->date('fin')->nullable()->default(NULL);
            $table->date('fin_dual')->nullable()->default(NULL);
            $table->integer('status')->nullable()->default('0');
            $table->integer('tipoBeca')->nullable()->default('0');
            $table->integer('estado_registro')->nullable()->default('0');
            $table->boolean('beca')->nullable()->default(false);
            $table->text('ine')->nullable();
            $table->text('evaluacion_form')->nullable()->default(NULL);
            $table->text('minutas')->nullable()->default(NULL);
            $table->text('carta_acp')->nullable()->default(NULL);
            $table->text('formatoA')->nullable()->default(NULL);
            $table->text('formatoB')->nullable()->default(NULL);
            $table->text('formatoC')->nullable()->default(NULL);
            $table->text('formato51')->nullable()->default(NULL);
            $table->text('formato54')->nullable()->default(NULL);
            $table->text('formato55')->nullable()->default(NULL);
            $table->text('plan_form')->nullable()->default(NULL);
            $table->text('historial_academico')->nullable()->default(NULL);
            $table->text('perfil_ingles')->nullable()->default(NULL);
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('empresa_id')->nullable()->constrained('empresas')->default(NULL);
            $table->foreignId('academico_id')->nullable()->constrained('users')->default(NULL);
            $table->foreignId('asesorin_id')->nullable()->constrained('mentor_industrials')->default(NULL);
            $table->foreignId('carrera_id')->constrained('carreras');
            $table->foreignId('direccion_id')->constrained('direccion_carreras');
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

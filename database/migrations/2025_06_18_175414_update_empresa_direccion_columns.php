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
        Schema::table('empresa_direccion', function (Blueprint $table) {
            if (Schema::hasColumn('empresa_direccion', 'direccion_carrera_id')) {
            $table->renameColumn('direccion_carrera_id', 'direccion_id');
        }
        
        $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        $table->foreign('direccion_id')->references('id')->on('direccion_carreras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresa_direccion', function (Blueprint $table) {
            //
        });
    }
};

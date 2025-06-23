<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAnexo12Table extends Migration
{
    public function up()
    {
        Schema::create('anexo_1_2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_elaboracion')->default(now());
            $table->foreignId('quien_elaboro_id')->constrained('directors'); // Relación con la tabla directors
            $table->string('nombre_firma_ie'); // Usuario con ID 1
            $table->longText('actividades'); // Actividades en formato JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anexo_1_2');
    }
}



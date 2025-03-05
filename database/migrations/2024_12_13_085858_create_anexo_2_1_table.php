<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexo21Table extends Migration
{
    public function up()
    {
        Schema::create('anexo_2_1', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unidad_economica');
            $table->string('periodo');
            $table->date('fecha');
            $table->longText('seccion_1'); // Cambiado a LONGTEXT
            $table->longText('seccion_2'); // Cambiado a LONGTEXT
            $table->longText('seccion_3'); // Cambiado a LONGTEXT
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anexo_2_1');
    }
}

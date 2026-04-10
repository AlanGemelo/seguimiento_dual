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
    public function up(): void
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['MARCO-EMPRESA', 'ESPECIFICO']);
            $table->date('inicio');
            $table->date('fin')->nullable();
            $table->enum('vigencia', ['INDEFINIDO', 'LIMITADO']);
            $table->string('archivo'); // ruta del PDF
            $table->integer('version')->default(1); // renovaciones
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
        Schema::dropIfExists('convenios');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maquinaria', function (Blueprint $table) {
            $table->id("ID");
            $table->text("Nombre");
            $table->text("Numero_de_serie");
            $table->binary("Imagen")->nullable(true);
            $table->text("Modelo");
            $table->boolean("En_seguimiento");
            $table->date("Fecha_adquisicion");
            $table->text("Observaciones_generales");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquinaria');
    }
};

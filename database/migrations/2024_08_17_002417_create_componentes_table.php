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
        Schema::create('componentes', function (Blueprint $table) {
            $table->id("ID");
            $table->text("Nombre");
            $table->text("Numero_de_serie");
            $table->binary("Imagen")->nullable(true);
            $table->text("Modelo");
            $table->text("Descripcion")->nullable(true);
            $table->text("Ubicacion");
            $table->enum("Estado", ["En uso", "Disponible", "Indisponible"]);
            $table->foreign("Ubicacion")->references("ID")->on("maquinaria");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('componentes');
    }
};

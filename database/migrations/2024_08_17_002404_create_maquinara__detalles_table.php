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
        Schema::create('maquinara__detalles', function (Blueprint $table) {
            $table->id("ID_maquinaria")->nullable(true);
            $table->integer("Capacidad_de_produccion");
            $table->integer("Voltaje");
            $table->integer("Peso");
            $table->text("Tipo");
            $table->boolean("Velocidad_ajustable");
            $table->boolean("Pantalla_digital");
            $table->boolean("Facil_desmontaje");
            $table->boolean("Garantia");
            $table->text("Problemas_recurrentes")->nullable(true);
            $table->foreign("ID_maquinaria")->references("ID")->on("maquinaria");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquinara__detalles');
    }
};

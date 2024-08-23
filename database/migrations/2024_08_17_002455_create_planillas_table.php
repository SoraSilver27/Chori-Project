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
        Schema::create('planillas', function (Blueprint $table) {
            $table->id("ID");
            $table->boolean("Es_de");
            $table->integer("ID_maquina")->nullable();
            $table->integer("ID_componente")->nullable();
            $table->date("Fecha");
            $table->text("Encargado");
            $table->text("Telefono_encargado");
            $table->foreign("ID_maquina")->references("ID")->on("maquina");
            $table->foreign("ID_componente")->references("ID")->on("componentes");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planillas');
    }
};

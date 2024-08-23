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
        Schema::create('mantenimientos__preventivos', function (Blueprint $table) {
            $table->id("ID");
            $table->boolean("Es_de");
            $table->integer("ID_maquina")->nullable(true);
            $table->integer("ID_componentes")->nullable(true);
            $table->enum("Intervalo_de_mantenimiento", ["Semanal","Mensual","Anual"]);
            $table->integer("Horas_de_servicio");
            $table->date("Ultimo_mantenimiento");
            $table->text("Que_se_hace");
            $table->foreign("ID_maquina")->references("ID")->on("maquina");
            $table->foreign("ID_componentes")->references("ID")->on("componentes");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos__preventivos');
    }
};

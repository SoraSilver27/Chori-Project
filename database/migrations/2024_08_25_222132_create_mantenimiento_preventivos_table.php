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
        Schema::create('mantenimiento_preventivos', function (Blueprint $table) {
            $table->id();
            $table->boolean("es_de");
            $table->id("id_maquina")->nullable()->autoIncrement(false);
            $table->id("id_componente")->nullable()->autoIncrement(false);
            $table->enum("intervalo_de_mantenimiento", ["semanal","mensual","anual"]);
            $table->integer("horas_de_servicio");
            $table->date("ultimo_mantenimiento");
            $table->string("que_se_hace");
            $table->foreign("id_maquina")->references("id")->on("maquinarias");
            $table->foreign("id_componente")->references("id")->on("componentes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimiento_preventivos');
    }
};

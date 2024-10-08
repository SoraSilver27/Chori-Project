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
            $table->id("id");
            $table->boolean("es_de");
            $table->boolean("tipo_planilla");
            $table->unsignedBigInteger("id_maquina")->nullable();
            $table->unsignedBigInteger("id_componente")->nullable();
            $table->date("fecha");
            $table->string("encargado");
            $table->string("telefono_encargado");
            $table->string("mantenimiento");
            $table->string("problema_detectado");
            $table->string("solucion_encontrada");
            $table->string("que_se_pudo_realizar");
            $table->boolean("requirio_tercerizacion");
            $table->boolean("amerita_seguimiento");
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
        Schema::dropIfExists('planillas');
    }
};

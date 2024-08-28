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
            $table->id();
            $table->boolean("es_de");
            $table->id("id_maquina")->autoIncrement(false);
            $table->id("id_componente")->autoIncrement(false);
            $table->date("fecha");
            $table->string("encargado");
            $table->string("telefono_encargado");
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

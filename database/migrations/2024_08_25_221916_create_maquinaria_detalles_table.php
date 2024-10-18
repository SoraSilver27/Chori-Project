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
        Schema::create('maquinaria_detalles', function (Blueprint $table) {
            $table->id("id");
            $table->unsignedBigInteger("id_maquinaria");
            $table->integer("capacidad_de_produccion");
            $table->integer("voltaje");
            $table->integer("peso");
            $table->string("tipo");
            $table->boolean("velocidad_ajustable");
            $table->boolean("pantalla_digital");
            $table->boolean("facil_desmontaje");
            $table->boolean("garantia");
            $table->string("garantia_cantidad")->default(0);
            $table->string("problemas_recurrentes");
            $table->integer("periodo_mantenimiento")->nullable();
            $table->string("mantenimiento")->nullable();
            $table->foreign("id_maquinaria")->references("id")->on("maquinarias");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquinaria_detalles');
    }
};

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
            $table->id("id_maquinaria")->primary()->autoIncrement(false);
            $table->integer("capacidad_de_produccion");
            $table->integer("voltaje");
            $table->integer("peso");
            $table->string("tipo");
            $table->boolean("velocidad_ajustable")->default(0);
            $table->boolean("pantalla_digital")->default(0);
            $table->boolean("facil_desmontaje")->default(0);
            $table->boolean("garantia")->default(0);
            $table->string("problemas_recurrentes")->default("Sin problemas recurrentes");
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

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
        Schema::create('planillas__correctivas', function (Blueprint $table) {
            $table->id("ID");
            $table->text("Problema_detectado");
            $table->text("Solucion_encontrada");
            $table->text("Que_se_pudo_realizar");
            $table->boolean("Requirio_tercerizacion");
            $table->boolean("Amerita_seguimiento");
            $table->foreign("ID")->references("ID")->on("planillas");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planillas__correctivas');
    }
};

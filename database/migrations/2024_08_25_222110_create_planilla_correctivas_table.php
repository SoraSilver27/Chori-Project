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
        Schema::create('planilla_correctivas', function (Blueprint $table) {
            $table->id();
            $table->string("problema_detectado");
            $table->string("solucion_encontrada");
            $table->string("que_se_pudo_realizar");
            $table->boolean("requirio_tercerizacion");
            $table->boolean("amerita_seguimiento");
            $table->foreign("id")->references("id")->on("planillas");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planilla_correctivas');
    }
};

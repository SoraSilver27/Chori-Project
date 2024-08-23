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
        Schema::create('planillas__preventivas', function (Blueprint $table) {
            $table->id("ID");
            $table->integer("ID_mantenimiento");
            $table->integer("Horas_de_servicio");
            $table->text("Trabajo_mantenimiento");
            $table->foreign("ID")->references("ID")->on("planillas");
            $table->foreign("ID_mantenimiento")->references("ID")->on("mantenimientos_preventivos");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planillas__preventivas');
    }
};

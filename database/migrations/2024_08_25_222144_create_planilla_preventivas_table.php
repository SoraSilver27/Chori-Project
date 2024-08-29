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
        Schema::create('planilla_preventivas', function (Blueprint $table) {
            $table->id();
            $table->id("mantenimiento")->autoIncrement(false);
            $table->id("horas_de_servicio")->autoIncrement(false);
            $table->string("trabajo_mantenimiento");
            $table->foreign("id")->references("id")->on("planillas");
            $table->foreign("mantenimiento")->references("id")->on("mantenimiento_preventivos");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planilla_preventivas');
    }
};

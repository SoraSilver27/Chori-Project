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
        Schema::create('repuestos_utilizados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_planilla')->index();
            $table->string("nombre_repuesto");
            $table->integer("cantidad");
            $table->foreign('id_planilla')->references('id')->on('planillas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repuestos_utilizados');
    }
};

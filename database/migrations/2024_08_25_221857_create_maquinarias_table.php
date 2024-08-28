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
        Schema::create('maquinarias', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("numero_de_serie");
            $table->enum("estado",["en_uso","disponible","indisponible"]);
            $table->binary("imagen")->nullable();
            $table->string("modelo");
            $table->boolean("en_seguimiento");
            $table->date("fecha_adquisicion");
            $table->string("observaciones_generales")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquinarias');
    }
};

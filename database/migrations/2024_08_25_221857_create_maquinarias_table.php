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
            $table->string("nombre")->default("Sin asignar");
            $table->string("numero_de_serie")->default("Sin asignar");
            $table->enum("estado",["En uso","Disponible","Indisponible"])->default("Disponible");
            $table->binary("imagen")->nullable();
            $table->string("modelo")->default("Sin asignar");
            $table->boolean("en_seguimiento")->default(0);
            $table->string("seguimiento")->default("Sin seguimiento");
            $table->date("fecha_adquisicion")->nullable();
            $table->date("ultimo_mantenimiento")->nullable();
            $table->date("proximo_mantenimiento")->nullable();
            $table->string("observaciones_generales")->default("Sin observaciones");
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

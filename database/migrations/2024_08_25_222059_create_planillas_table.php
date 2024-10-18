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
            $table->id("id");
            $table->boolean("es_de");
            $table->enum("tipo_planilla",["Preventivo","Correctivo","Otro"]);
            $table->string("aclarar")->nullable();
            $table->unsignedBigInteger("id_maquina")->nullable();
            $table->unsignedBigInteger("id_componente")->nullable();
            $table->date("fecha")->nullable();
            $table->string("encargado")->nullable();
            $table->string("telefono_encargado")->nullable();
            $table->string("mantenimiento")->nullable();
            $table->string("problema_detectado")->nullable();
            $table->string("solucion_encontrada")->nullable();
            $table->string("que_se_pudo_realizar")->nullable();
            $table->boolean("requirio_tercerizacion")->nullable();
            $table->boolean("amerita_seguimiento")->nullable();
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

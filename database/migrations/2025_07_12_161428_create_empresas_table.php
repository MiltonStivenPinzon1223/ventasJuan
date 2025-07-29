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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->string('ruc', 50);
            $table->string('propietario');
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion');
            $table->string('ubicacion')->nullable();
            $table->string('abreviatura_impuesto')->default('IVA');
            $table->string('porventaje_impuesto', 5, 2)->default('IVA');
            $table->foreignId('divisa_id')->unique()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};

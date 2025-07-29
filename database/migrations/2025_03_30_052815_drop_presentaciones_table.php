<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::dropIfExists('presentaciones'); // Elimina la tabla
    }

    public function down() {
        Schema::create('presentaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caracteristica_id')->unique()->constrained('caracteristicas')->onDelete('cascade');
            $table->timestamps();
        });
    }
};

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
        Schema::create('cuyes', function (Blueprint $table) {
            $table->id();

            // Relación con proveedores
            $table->foreignId('proveedor_id')
                ->constrained('proveedores')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->string('nombre');
            $table->integer('cantidad_disponible');
            $table->decimal('precio_unitario', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuyes');
    }
};

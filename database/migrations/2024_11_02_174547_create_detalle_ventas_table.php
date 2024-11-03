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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
    
            // Relación con ventas
            $table->foreignId('venta_id')
                ->constrained('ventas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
    
            // Relación con platos
            $table->foreignId('plato_id')
                ->constrained('platos_cuy')
                ->onUpdate('cascade')
                ->onDelete('restrict');
    
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};

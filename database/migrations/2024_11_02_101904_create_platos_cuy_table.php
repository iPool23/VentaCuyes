<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('platos_cuy', function (Blueprint $table) {
            $table->id();
            
            // Relación con proveedores (quien provee los cuyes)
            $table->foreignId('proveedor_id')
                ->constrained('proveedores')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            
            // Campos del plato
            $table->string('nombre_plato');
            $table->enum('tipo_preparacion', [
                'Cuy Chactado',
                'Cuy al Horno',
                'Cuy Frito',
                'Cuy al Palo',
                'Pepián de Cuy'
            ]);
            $table->text('descripcion');
            $table->decimal('precio_plato', 10, 2);
            $table->integer('tiempo_preparacion')->comment('Tiempo en minutos');
            $table->boolean('disponible')->default(true);
            $table->text('ingredientes')->nullable();
            $table->string('imagen_plato')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platos_cuy');
    }
};
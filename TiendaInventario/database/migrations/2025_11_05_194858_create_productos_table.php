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
        // El comando 'Schema::create' usará el nombre 'productos'
        // que le pasaste al comando artisan.
        Schema::create('productos', function (Blueprint $table) {

            // 'id' autoincremental y clave primaria
            $table->id();

            // Campos requeridos por el examen:
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable(); // 'nullable' permite que esté vacío
            $table->decimal('precio', 10, 2)->default(0);
            $table->decimal('descuento', 5, 2)->default(0);
            $table->integer('cantidad_stock')->default(0);

            // 'timestamps' crea las columnas 'created_at' y 'updated_at'
            // (Es una buena práctica de Laravel)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

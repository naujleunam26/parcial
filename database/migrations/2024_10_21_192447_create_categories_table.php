<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Campo 'id' como clave primaria (entero)
            $table->string('name'); // Campo 'name' como cadena
            $table->text('description')->nullable(); // Campo 'description' como texto largo, opcional
            $table->boolean('is_active')->default(true); // Campo 'is_active' como booleano con valor predeterminado
            $table->timestamps(); // Campos 'created_at' y 'updated_at'
        });
    }

    /**
     * Revertir la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

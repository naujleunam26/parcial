<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Agregar el campo 'category_id' como llave foránea a 'products'
            $table->unsignedBigInteger('category_id')->nullable();  // Se permite 'nullable' si algunos productos no tienen categoría

            // Definir la relación foránea
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Eliminar la relación foránea y el campo 'category_id'
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}

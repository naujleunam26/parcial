<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Aquí puedes definir los atributos que el modelo puede llenar masivamente
    protected $fillable = ['name', 'description', 'stock', 'price', 'available', 'release_date', 'category', 'attributes'];
    // Relación N a 1: Un producto pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

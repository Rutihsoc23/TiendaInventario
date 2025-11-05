<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     * (Laravel lo adivina, pero es bueno ser explícito)
     * @var string
     */
    protected $table = 'productos';

    /**
     * Los atributos que se pueden asignar en masa.
     * Esto es para los métodos Create y Update.
     * Deben coincidir con los campos del formulario y la migración.
     * * [cite_start]Basado en los requisitos del examen [cite: 11]
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'descuento',
        'cantidad_stock',
    ];

    /**
     * (Opcional) Atributos que deben ser convertidos a tipos nativos.
     * Esto es útil para 'precio' y 'descuento' para que siempre sean números.
     */
    protected $casts = [
        'precio' => 'decimal:2',
        'descuento' => 'decimal:2',
        'cantidad_stock' => 'integer',
    ];
}

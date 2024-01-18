<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name'
    ];

    protected static function boot()
    {
        parent::boot();

        // Se ejecuta antes de crear un nuevo registro
        static::creating(function ($model) {
            // Obtiene el name del modelo
            $name = $model->name;
            // Separa el name por espacios y obtiene la primera letra de cada palabra
            $letters = array_map(function ($word) {
                return substr($word, 0, 1);
            }, explode(' ', $name));
            // Une las letras en el code
            $code = implode('', $letters);
            // Asigna el code al modelo
            $model->code = $code;
        });

        static::updated(function ($model) {
            // Obtiene el name del modelo
            $name = $model->name;
            // Separa el name por espacios y obtiene la primera letra de cada palabra
            $letters = array_map(function ($word) {
                return substr($word, 0, 1);
            }, explode(' ', $name));
            // Une las letras en el code
            $code = implode('', $letters);
            // Asigna el code al modelo
            $model->code = $code;
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'rfc',
        'street',
        'number',
        'interior',
        'neighborhood',
        'city',
        'state'
    ];

    // Definir el método boot
    protected static function boot()
    {
        parent::boot();

        // Asignar el valor del campo code al crear el modelo
        static::creating(function ($company) {
            $company->code = self::generateCode();
        });
    }



    // Definir la función que genera el código alfanumérico
    private static function generateCode()
    {
        // Definir los caracteres posibles
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Definir el largo del código entre 4 y 5
        $length = rand(4, 5);

        // Generar el código aleatorio
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        // Devolver el código
        return $code;
    }
}

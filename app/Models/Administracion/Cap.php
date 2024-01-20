<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cap extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'contact',
        'email',
        'phone',
        'street',
        'number',
        'interior',
        'neighborhood',
        'city',
        'state'
    ];
}

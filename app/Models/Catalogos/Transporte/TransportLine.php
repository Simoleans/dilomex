<?php

namespace App\Models\Catalogos\Transporte;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'address',
        'contact',
        'email',
        'phone',
        'own_line',
    ];
}

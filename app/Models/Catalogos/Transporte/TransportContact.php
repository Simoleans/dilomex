<?php

namespace App\Models\Catalogos\Transporte;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'type',
    ];

    //scope driver
    public function scopeType($query,$type)
    {
        return $query->where('type', $type);
    }


}

<?php

namespace App\Models\Catalogos\Tarifas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class KilometerCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'cost',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

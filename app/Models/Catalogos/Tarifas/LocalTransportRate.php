<?php

namespace App\Models\Catalogos\Tarifas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Distribution, UnitType};

class LocalTransportRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'distribution_id',
        'uni_type_id',
        'cost',
    ];

    public function distribution()
    {
        return $this->belongsTo(Distribution::class);
    }

    public function uniType()
    {
        return $this->belongsTo(UnitType::class, 'uni_type_id');
    }
}

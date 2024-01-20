<?php

namespace App\Models\Catalogos\Tarifas;

use App\Models\{Population, UnitType};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTravel extends Model
{
    use HasFactory;

    protected $fillable = [
        'population_id',
        'uni_type_id',
        'cost',
    ];

    public function population()
    {
        return $this->belongsTo(Population::class);
    }

    public function uniType()
    {
        return $this->belongsTo(UnitType::class);
    }
}

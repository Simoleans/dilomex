<?php

namespace App\Models\Catalogos\Tarifas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Company, Location};

class CompanyCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'location_id',
        'type',
        'cost'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

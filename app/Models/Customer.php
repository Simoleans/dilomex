<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
      'code',
      'company_id',
      'name',
      'customer_type_id',
      'state',
      'street',
      'colony',
      'postal_code',
      'location_id',
      'priority'
    ];

    public function company()
    {
      return $this->belongsTo(Company::class);
    }

    public function customerType()
    {
      return $this->belongsTo(CustomerType::class, 'customer_type_id');
    }

    public function location()
    {
      return $this->belongsTo(Location::class);
    }
}

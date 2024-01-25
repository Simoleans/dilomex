<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_invoice',
        'invoice_type_id',
        'customer_id',
        'territory',
        'company_id',
        'family_id',
        'invoice_status_id',
        'box_invoice',
        'concentrated',
        'weight',
        'order',
        'price',
        'box_missing',
        'part_missing',
        'observations_missing',
        'date_concentrated',
        'date_invoice',
        'date_portage',
        'date_date',
        'part_invoice',
        'volume',
        'currency',
        'observations_invoice',
        'barcode'
    ];

    public function invoiceType()
    {
        return $this->belongsTo(InvoiceType::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function invoiceStatus()
    {
        return $this->belongsTo(InvoiceStatus::class);
    }
}

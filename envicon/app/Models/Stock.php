<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_id',
        'supplier_name',
        'quantity_added',
        'last_added_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

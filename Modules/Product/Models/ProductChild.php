<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\Product;
use Modules\Unit\Models\Unit;

class ProductChild extends Model
{
    use HasFactory;

    protected $table = 'product_children';

    protected $fillable = [
        'item_code',
        'product_id',
        'quantity',
        'weight',
        'unit_id',
        'price',
        'in_stock',
        'name',
        'image',
        'description',
        'duration',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:3',
        'quantity' => 'decimal:3',
        'weight' => 'decimal:3',
        'duration' => 'decimal:3',
        'in_stock' => 'integer',
        'status' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}

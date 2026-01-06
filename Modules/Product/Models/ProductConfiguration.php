<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\Product;

class ProductConfiguration extends Model
{
    use HasFactory;

    protected $table = 'product_configurations';

    protected $fillable = [
        'product_id',
        'is_subscribable',
        'is_container',
        'is_feature',
        'is_taxable'
    ];

    protected $casts = [
        'is_subscribable' => 'boolean',
        'is_container' => 'boolean',
        'is_feature' => 'boolean',
        'is_taxable' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

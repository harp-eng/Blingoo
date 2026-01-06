<?php

namespace Modules\Product\Models;

use App\Models\BaseModel;
use App\Models\ProductChild;
use App\Models\ProductConfiguration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\database\factories\ProductFactory;
use Modules\Unit\Models\Unit;

class Product extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Product\database\factories\ProductFactory::new();
    }

    protected $fillable = [
        'item_code',
        'category_id',
        'sub_cat_id',
        'brand_id',
        'name',
        'slug',
        'price',
        'quantity',
        'weight',
        'in_stock',
        'unit_id',
        'status',
        'image',
        'description',
        'type',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $casts = [
        'price' => 'decimal:3',
        'quantity' => 'decimal:3',
        'weight' => 'decimal:3',
        'in_stock' => 'integer',
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_cat_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function children()
    {
        return $this->hasMany(ProductChild::class, 'product_id');
    }

    public function configurations()
    {
        return $this->hasOne(ProductConfiguration::class, 'product_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}

<?php

namespace Modules\Category\Models;

use App\Models\BaseModel;
use App\Models\MetaData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Category extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';
    public static $module = 'categories';

    /**
     * Caegories has Many posts.
     */
    public function posts()
    {
        return $this->hasMany('Modules\Post\Models\Post');
    }

    public function metaData()
    {
        return $this->morphOne(MetaData::class, 'model');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Category\database\factories\CategoryFactory::new();
    }

    protected static function booted()
    {
        static::saved(fn($model) => Cache::forget(self::$module));
        static::updated(fn($model) => Cache::forget(self::$module));
        static::updating(fn($model) => Cache::forget(self::$module));
        static::deleted(fn($model) => Cache::forget(self::$module));
    }

    /**
     * Get the parent category.
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Get the child categories.
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}

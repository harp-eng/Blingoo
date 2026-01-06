<?php

namespace Modules\Banner\Models;

use App\Models\BaseModel;
use App\Models\MetaData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Banner extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'banners';
    public static $module = 'banners';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Banner\database\factories\BannerFactory::new();
    }

    public function metaData()
    {
        return $this->morphOne(MetaData::class, 'model');
    }

    protected static function booted()
    {
        static::saved(fn($model) => Cache::forget(self::$module));
        static::deleted(fn($model) => Cache::forget(self::$module));
    }
}

<?php

namespace Modules\Area\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'areas';

    protected $fillable = [
        'name',
        'description',
        'area_type',
        'vendor_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Area\database\factories\AreaFactory::new();
    }

    public function polygons()
    {
        return $this->hasMany(AreaPolygon::class);
    }

    public function postcodes()
    {
        return $this->hasMany(AreaPostcode::class);
    }

    public function availability()
    {
        return $this->hasMany(AreaAvailability::class);
    }
}

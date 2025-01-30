<?php

namespace Modules\Area\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaPolygon extends BaseModel
{
    use HasFactory;

    protected $fillable = ['area_id', 'coordinates', 'sequence'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}

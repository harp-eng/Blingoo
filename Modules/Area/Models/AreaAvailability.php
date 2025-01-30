<?php

namespace Modules\Area\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaAvailability extends BaseModel
{
    use HasFactory;

    protected $table = 'area_availabilities';

    protected $fillable = ['area_id', 'day', 'available'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}

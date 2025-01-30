<?php

namespace Modules\Unit\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'units';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Unit\database\factories\UnitFactory::new();
    }
}

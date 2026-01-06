<?php

namespace Modules\Container\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Container extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'containers';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Container\database\factories\ContainerFactory::new();
    }
}

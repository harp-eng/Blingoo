<?php

namespace Modules\DeliveryRoute\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryRoute extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'deliveryroutes';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\DeliveryRoute\database\factories\DeliveryRouteFactory::new();
    }
}

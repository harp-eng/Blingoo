<?php

namespace Modules\DeliveryTimeSlot\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryTimeSlot extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'deliverytimeslots';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\DeliveryTimeSlot\database\factories\DeliveryTimeSlotFactory::new();
    }
}

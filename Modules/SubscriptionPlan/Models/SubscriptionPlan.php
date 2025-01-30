<?php

namespace Modules\SubscriptionPlan\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'subscriptionplans';

    protected $fillable = ['name', 'duration_days', 'description'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\SubscriptionPlan\database\factories\SubscriptionPlanFactory::new();
    }


    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}

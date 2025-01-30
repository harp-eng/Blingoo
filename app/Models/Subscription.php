<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'plan_id', 'start_date', 'end_date', 'next_billing_date', 'frequency', 'payment_type', 'total_amount', 'paid_amount', 'status', 'payment_method'];

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function products()
    {
        return $this->hasMany(SubscriptionProduct::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

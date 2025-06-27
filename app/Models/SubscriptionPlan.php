<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $table = 'subscription_plans';

    protected $guarded = [];

    public function payments()
    {
        return $this->hasMany(SubscriptionPlan::class);
    }

    // Relationship to Users (through subscriptions)
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'subscription_payments')
            ->using(SubscriptionPlan::class)
            ->withPivot(['amount', 'status', 'payment_date']);
    }
}

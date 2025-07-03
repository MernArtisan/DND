<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    // Check if subscription is still active
    public function isCurrentlyActive()
    {
        return $this->is_active && $this->end_date->isFuture();
    }

    public function isExpired()
    {
        return $this->end_date->isPast();
    }
}

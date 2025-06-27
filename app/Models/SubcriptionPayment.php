<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubcriptionPayment extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'payment_id',
        'amount',
        'currency',
        'status',
        'payment_date'
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Plan
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }
}

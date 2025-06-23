<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'phone_code',
        'image',
        'gender',
        'age',
        'country',
        'state',
        'city',
        'address',
        'zipcode',
        'dob',
        'language',
        'timezone',
        'bio',
        'website',
        'facebook',
        'twitter',
        'linkedin',
        'is_active',
        'last_login_at',
        'email_verified_at',
    ];

    protected $dates = [
        'last_login_at',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getImageAttribute($value)
    {
        return $value ? asset($value) : asset('default-man.png');
    }


    public function channel()
    {
        return $this->hasMany(Channel::class, 'streamer_id');
    }

    public function savedHighLights()
    {
        return $this->belongsToMany(Highlight::class, 'saved_highlights')
            ->withTimestamps()
            ->withPivot('saved_at');
    }
 
}

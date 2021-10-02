<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'dateOfBirth',
        'exceprience',
        'gender',
        'phone',
        'pic',
        'city_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email_verified_at' => 'timestamp',
        'dateOfBirth' => 'timestamp',
        'city_id' => 'integer',
    ];


    public function roles()
    {
        return $this->hasMany(\App\Models\Role::class);
    }

    public function tutors()
    {
        return $this->hasMany(\App\Models\Tutor::class);
    }

    public function lesssons()
    {
        return $this->hasMany(\App\Models\Lessson::class);
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }
}

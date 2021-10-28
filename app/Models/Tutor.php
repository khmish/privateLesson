<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutor extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title_cert',
        'price',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];


    public function tutorSubs()
    {
        return $this->hasMany(\App\Models\TutorSub::class);
    }

    public function tutorLevelEducations()
    {
        return $this->hasMany(\App\Models\TutorLevelEducation::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

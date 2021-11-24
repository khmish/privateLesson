<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stars',
        'teacher_id',
        'student_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'teacher_id' => 'integer',
        'student_id' => 'integer',
    ];


    public function teacher()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

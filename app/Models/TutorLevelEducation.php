<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TutorLevelEducation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tutor_id',
        'leveleducation_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tutor_id' => 'integer',
        'leveleducation_id' => 'integer',
    ];


    public function tutor()
    {
        return $this->belongsTo(\App\Models\Tutor::class);
    }

    public function leveleducation()
    {
        return $this->belongsTo(\App\Models\Leveleducation::class);
    }
}

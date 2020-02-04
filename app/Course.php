<?php

namespace Buka;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'short_description', 'description', 'price',
        'course_time', 'start_at', 'end_at', 'teacher_id',
        'schedule', 'link', 'level_id'
    ];

    protected $attributes = [
        'status' => 'pendente',
        'price' => 0
    ];
}

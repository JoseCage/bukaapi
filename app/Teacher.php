<?php

namespace Buka;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'photo', 'email', 'phone'
    ];

    public function courses()
    {
      return $this->hasMany(Course::class);
    }
}

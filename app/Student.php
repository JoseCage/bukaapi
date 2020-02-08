<?php

namespace Buka;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
      'name', 'email', 'phone', 'username'
    ];

    
    public function courses()
    {
      return $this->belongsToMany('Buka\Course');
    }
}

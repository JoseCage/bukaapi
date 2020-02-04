<?php

namespace Buka;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
      'name', 'email', 'phone', 'username'
    ];
}

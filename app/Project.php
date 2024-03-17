<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $dates = [
      'start_date',
      'deadline',
    ];
}

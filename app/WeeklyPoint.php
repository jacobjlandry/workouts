<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeeklyPoint extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'start', 'end'];
}

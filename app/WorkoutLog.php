<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkoutLog extends Model
{
    protected $fillable = ['user_id', 'workout_id', 'value'];

    public function user()
    {
        return $this->hasOne('\App\User');
    }

    public function workout()
    {
        return $this->hasOne('\App\Workout');
    }
}

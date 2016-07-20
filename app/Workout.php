<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = ['name', 'units', 'value'];

    /**
     * Calculate the number of a points a user has achieved
     *
     * @param $achieved
     * @return float
     */
    public function points($achieved)
    {
        return $this->value * $achieved;
    }

    public function logs()
    {
        return $this->hasMany('\App\WorkoutLog');
    }
}

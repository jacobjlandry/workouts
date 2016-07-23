<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Log;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Initialize a user
     */
    public function init()
    {
        if(!$this->hasOne('\App\WeeklyPoint')->count()) {
            \App\WeeklyPoint::create([
                'user_id' => $this->id,
                'start' => date('Y-m-d', strtotime('last Sunday')),
                'end' => date('Y-m-d', strtotime('next Saturday'))
            ]);
        }
    }

    public function goal()
    {
        if(!$this->hasOne('\App\Goal')->get()->isEmpty()) {
            return $this->hasOne('\App\Goal')->first();
        }
        else {
            return collect(array());
        }
    }

    /**
     * Get a user's points for the current week
     *
     * @return mixed
     */
    public function points()
    {
        return $this->hasOne('\App\WeeklyPoint')->first();
    }

    /**
     * Get progress (including extra credit)
     *
     * @param $extra
     * @return float
     */
    public function progress($extra = 0)
    {
        if(!$extra) {
            return round(($this->points()->points / $this->goal()->goal) * 100);
        }
        else {
            $points = $this->points()->points - ($this->goal()->goal * $extra);
            return round(($points / $this->goal()->goal) * 100);
        }
    }

    /**
     * Get all points a user has accrued
     *
     * @return mixed
     */
    public function allPoints()
    {
        return $this->hasMany('\App\WeeklyPoint')->withTrashed()->get();
    }

    /**
     * Add points to a user's weekly sum
     *
     * @param $points
     */
    public function logWorkout($points)
    {
        $this->hasOne('\App\WeeklyPoint')->increment('points', $points);
    }

    /**
     * Get a log of all activity completed
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function log()
    {
        return $this->hasMany('\App\WorkoutLog');
    }
}

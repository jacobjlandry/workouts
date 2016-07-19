<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->hasOne('\App\Goal')->first();
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

    public function progress()
    {
        return round(($this->points()->points / $this->goal()->goal) * 100);
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
}

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;

Route::auth();

Route::get('/', function () {
    $workouts = \App\Workout::all();
    return view('welcome', ['workouts' => $workouts]);
});

Route::get('/home', function () {
    $workouts = \App\Workout::all();
    return view('welcome', ['workouts' => $workouts]);
});

Route::get('/goal/create', function() {
    return view('goals.create');
});

Route::post('/goal/create', function(Request $request) {
    \App\Goal::create(['user_id' => Auth::user()->id, 'goal' => $request->input('goal'), 'name' => $request->input('reward')]);

    return redirect('/');
});

Route::get('workout/create', function() {
    return view('workouts.create');
});

Route::post('workout/create', function(Request $request) {
    \App\Workout::create(['name' => $request->input('name'), 'units' => $request->input('units'), 'value' => $request->input('value')]);

    return redirect('/');
});

Route::post('/workout/add', function(Request $request) {
    $workout = \App\Workout::find($request->input('workout'));
    \App\WorkoutLog::create(['workout_id' => $workout->id, 'user_id' => Auth()->user()->id, 'value' => $request->input('points')]);
    \App\WeeklyPoint::where('user_id', Auth::user()->id)->increment('points', $workout->points($request->input('points')));

    return redirect('/');
});
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
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/goal/create', function() {
    return view('goals.create');
});

Route::post('/goal/create', function(Request $request) {
    \App\Goal::create(['user_id' => Auth::user()->id, 'goal' => $request->input('goal'), 'name' => $request->input('reward')]);

    return redirect('/');
});

Route::post('/workout/add', function(Request $request) {
    \App\WeeklyPoint::where('user_id', Auth::user()->id)->increment('points', $request->input('points'));

    return redirect('/');
});
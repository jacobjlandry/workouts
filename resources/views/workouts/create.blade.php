@extends('master')

@section('content')
    <div class="title">New Workout!</div>
    <div class="subtitle">Create an activity</div>
    <br />
    <div class="form">
        <form method="POST">
            {{ csrf_field() }}
            <label for="name">Name</label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Name" />
            <br />
            <label for="units">Units</label>
            <input id="units" name="units" type="text" class="form-control" placeholder="Units" />
            <br />
            <label for="value">Value</label>
            <input id="value" name="value" type="text" class="form-control" placeholder="Value Per Unit" />
            <br />
            <div class="submit" style="text-align: center;">
                <button type='submit' id='go' class="btn btn-success">Let's Go!</button>
            </div>
        </form>
    </div>
@endsection
@extends('master')

@section('content')
    @if(!Auth::check())
        <div class="title">Welcome!</div>
        <div class="subtitle">Login to get started!</div>
    @else
        {{ Auth::user()->init() }}
        <div class="title">Let's Work Out!</div>
        <div class="subtitle"></div>
    @endif

    @if(Auth::check() && !Auth::user()->goal()->count())
        <script type="text/javascript">
            $(document).ready(function() {
                setTimeout(alert, 2000);
                setTimeout(redirect, 6000);

                function alert() {
                    $('.subtitle').text('Oops! You haven\'t set up a goal yet, let\'s do that now!');
                }

                function redirect() {
                    window.location = '/goal/create';
                }
            });
        </script>
    @elseif(Auth::check())
        <script type="text/javascript">
            $('.subtitle').text('It looks like you\'ve set up a goal. That\'s great! Let\'s get moving!');
        </script>
        <br />
        <form action="/workout/add" method="POST">
            {{ csrf_field() }}
            <select class="form-control" name="workout">
                @foreach($workouts as $workout)
                    <option value="{{ $workout->id }}">{{ $workout->name }}</option>
                @endforeach
            </select>
            <br />
            <input type="text" name="points" class="form-control" placeholder="x miles" />
            <br />
            <button type="submit" class="btn btn-success">Log It!</button>
        </form>
        <br />
        <label for="status">Progress to {{ Auth::user()->goal()->first()->name }}</label>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{{ Auth::user()->points()->points }}" aria-valuemin="0" aria-valuemax="{{ Auth::user()->goal()->goal }}" style="width: {{ Auth::user()->progress() }}%">
                <span class="sr-only">{{ Auth::user()->progress() }}% Complete</span>
            </div>
        </div>
    @endif
@endsection

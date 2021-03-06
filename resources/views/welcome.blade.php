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
            $('.subtitle').addClass('hide-small-screen');
        </script>
        <br />
        <form action="/workout/add" method="POST">
            {{ csrf_field() }}
            <div style="display: flex;">
                <select class="form-control" id="workout" name="workout">
                    @foreach($workouts as $workout)
                        <option value="{{ $workout->id }}" unit="{{ $workout->units }}">{{ $workout->name }} ({{ $workout->value }} points per {{ preg_replace('/s$/', '', $workout->units) }})</option>
                    @endforeach
                </select>
                <div class="show-small-screen" style="padding: 30px;">
                    <i class="fa fa-caret-down" style="font-size: 95px; color: #cccccc;"></i>
                </div>
            </div>
            <br />
            <input type="text" name="points" class="form-control" id="workoutunits" placeholder="{{ @$workouts->first()->units }}" />
            <br />
            <button type="submit" class="btn btn-success">Log It!</button>
        </form>
        <br />
        @if(Auth::user()->progress() < 100)
            <label for="status">Progress to {{ Auth::user()->goal()->first()->name }}</label>
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{{ Auth::user()->points()->points }}" aria-valuemin="0" aria-valuemax="{{ Auth::user()->goal()->goal }}" style="width: {{ Auth::user()->progress() }}%">
                    <span class="sr-only">{{ Auth::user()->progress() }}% Complete</span>
                </div>
            </div>
        @else
            <div class="subtitle hide-small-screen">
                You have achieved your weekly goal! Enjoy your reward!
            </div>
            <div class="subtitle show-small-screen">
                You did it!
            </div>
            <br />
            <div style="text-align: center;">
                <img class="goal-img" src="{{ asset('goals/' . Auth::user()->goal()->image) }}" />
            </div>
            <br />
            <div>
                <label for="status">Progress to {{ Auth::user()->goal()->first()->name }} (Extra Credit)</label>
                @for($x = 0; $x <= round(Auth::user()->progress()/100); $x++)
                    <div style="display: flex; flex-direction: row; flex-wrap: nowrap;">
                        <div class="progress" style="order: 1; flex-grow: 99;">
                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ Auth::user()->points()->points - ($x * Auth::user()->goal()->goal) }}" aria-valuemin="0" aria-valuemax="{{ Auth::user()->goal()->goal }}" style="width: {{ Auth::user()->progress($x) }}%">
                                <span class="sr-only">{{ storage_path('app/public/goals') . Auth::user()->progress($x) }}% Complete</span>
                            </div>
                        </div>
                        <div class="trophy" style="order: 2; flex-grow: 1; padding-left: 10px;">
                            <i class="fa fa-trophy fa-2x extra-credit"></i>
                        </div>
                    </div>
                @endfor
            </div>
        @endif
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            $('#workout').on('change', function(e) {
                var units = $('#workout option:selected').attr('unit');
                $('#workoutunits').attr('placeholder', units);
            });
        });
    </script>
@endsection

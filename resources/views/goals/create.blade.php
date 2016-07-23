@extends('master')

@section('content')
    <div class="title">New Goal!</div>
    <div class="subtitle">What would you like to achieve?</div>
    <br />
    <div class="form">
        <form method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="goal">Goal</label>
            <input id="goal" name="goal" type="text" class="form-control" placeholder="Goal" />
            <br />
            <label for="reward">Reward</label>
            <input id="reward" name="reward" type="text" class="form-control" placeholder="Reward" />
            <br />
            <label for="image">Image of Reward</label>
            <input id='image' name='image' type="file" class="form-control" />
            <br />
            <div class="submit" style="text-align: center;">
                <button type='submit' id='go' class="btn btn-success">Let's Go!</button>
            </div>
        </form>
    </div>
@endsection
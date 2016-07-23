<!DOCTYPE html>
<html>
    <head>
        <title>Workouts</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
            }

            .content {
                padding-top: 50px;
                margin: auto;
            }

            .title {
                font-size: 96px;
            }
            .subtitle {
                font-size: 30px;
                text-align: center;
            }

            .navbar {
                position: fixed;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 50px;
                display: flex;
                justify-content: flex-end;
                background: #ffffff;
            }
            .navicon, .navicon a {
                padding: 5px;
                color: #000000;
                font-size: 22px;
                font-weight: bold;
            }
            .results {
                display: flex;

                .goal-img {
                    max-width: 150px;
                    max-height: 400px;
                    overflow: hidden;
                }
            }
            .extra-credit {
                color: #DAA520;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            @if(!Auth::check())
                <div class="navicon">
                    <a href="/login">Login</a>
                </div>
            @else
                @if(Auth::user()->is('admin') || Auth::user()->is('editor'))
                    <div class="navicon">
                        <a href="/workout/create">Create Workout</a>
                    </div>
                @endif
                <div class="navicon">
                    <a href="/logout">Logout</a>
                </div>
            @endif
        </div>
        <div class="container">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>

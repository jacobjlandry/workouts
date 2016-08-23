<!DOCTYPE html>
<html>
    <head>
        <title>Workouts</title>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

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
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
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

            .results {
                display: flex;
            }
            .extra-credit {
                color: #DAA520;
            }
            @media (min-width: 480px) and (orientation: portrait) {
                body {
                    padding-left: 15px;
                }
                .title {
                    margin-top: 45px;
                    font-size: 150px;
                }
                .subtitle {
                    font-size: 75px;
                }
                .navbar {
                    position: fixed;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    display: flex;
                    justify-content: flex-end;
                    height: 80px;
                    background: #cccccc;
                }
                .navicon, .navicon a {
                    padding-right: 10px;
                    padding-left: 10px;
                    font-size: 50px;
                    color: #ffffff;
                    font-weight: bold;
                    display: flex;
                }
                #create-text {
                    display: none;
                }
                #logout-text {
                    display: none;
                }
                .goal-img {
                    max-width: 800px;
                    max-height: 800px;
                    overflow: hidden;
                }
            }
            @media (min-width: 700px) and (orientation: landscape) {
                .title {
                    font-size: 100px;
                }
                .subtitle {
                    font-size: 50px;
                }
                .navbar {
                    position: fixed;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    display: flex;
                    justify-content: flex-end;
                    height: 30px;
                    background: #cccccc;
                }
                .navicon, .navicon a {
                    padding-right: 10px;
                    padding-left: 10px;
                    font-size: 30px;
                    color: #ffffff;
                    font-weight: bold;
                }
                #create-icon {
                    display: none;
                }
                #logout-icon {
                    display: none;
                }
                .goal-img {
                    max-width: 250px;
                    max-height: 400px;
                    overflow: hidden;
                }
            }
            @media (min-width: 1000px) {
                .title {
                    font-size: 130px;
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
                    color: #AAAAAA;
                    font-size: 20px;
                    font-weight: normal;
                    display: flex;
                }
                #create-icon {
                    display: none;
                }
                #logout-icon {
                    display: none;
                }
                .goal-img {
                    max-width: 250px;
                    max-height: 400px;
                    overflow: hidden;
                }
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
                        <div id="create-text"><a href="/workout/create">Create Workout</a></div>
                        <div id="create-icon" style="padding: 15px;"><a href="/workout/create"><i class="fa fa-plus"></i></a></div>
                    </div>
                @endif
                <div class="navicon">
                    <div id="logout-text"><a href="/logout">Logout</a></div>
                    <div id="logout-icon" style="padding: 15px;"><a href="/logout"><i class="fa fa-sign-out"></i></a></div>
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

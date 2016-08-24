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
                margin: auto;
            }

            .results {
                display: flex;
            }
            .extra-credit {
                color: #DAA520;
            }

            /* Default */
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
                border-bottom: 1px solid #cccccc;
            }
            .navicon, .navicon a {
                padding: 5px;
                color: #AAAAAA;
                font-size: 20px;
                font-weight: normal;
                display: flex;
            }
            #login-icon {
                display: none;
            }
            #create-icon {
                display: none;
            }
            #logout-icon {
                display: none;
            }
            .content {
                margin-top: 50px;
                margin-bottom: 50px;
            }
            .goal-img {
                max-width: 250px;
                max-height: 400px;
                overflow: hidden;
            }

            .hide-small-screen {
                display: block;
            }
            .show-small-screen {
                display: none;
            }

            /* iPhone 6 Portrait */
            @media only screen
            and (min-device-width: 375px)
            and (max-device-width: 667px)
            and (-webkit-min-device-pixel-ratio: 2)
            and (orientation: portrait) {
                .title {
                    font-size: 175px;
                }
                .subtitle {
                    font-size: 100px;
                }
                .navbar {
                    height: 125px;
                    border-bottom: 2px solid #cccccc;
                }
                .navicon, .navicon a {
                    margin-right: 20px;
                    margin-left: 20px;
                    padding: 10px;
                    font-size: 80px;
                }
                #login-text {
                    display: none;
                }
                #create-text {
                    display: none;
                }
                #logout-text {
                    display: none;
                }
                #login-icon {
                    display: block;
                }
                #create-icon {
                    display: block;
                }
                #logout-icon {
                    display: block;
                }

                .content {
                    margin-top: 150px;
                }
                .goal-img {
                    max-width: 800px;
                    max-height: 800px;
                    overflow: hidden;
                }
                .hide-small-screen {
                    display: none;
                }
                .show-small-screen {
                    display: block;
                }

                select.form-control {
                    -webkit-appearance: none; -moz-appearance: none;
                    height: 150px;
                    font-size: 95px;
                }

                input[type=text] {

                    display: block;
                    margin: 0;
                    width: 100%; height: 150px;
                    line-height: 150px; font-size: 95px;
                    border: 1px solid #bbb;
                }

                button[type=submit] {
                    -webkit-appearance: none; -moz-appearance: none;
                    display: block;
                    margin: 1.5em 0;
                    font-size: 45px; line-height: 40px;
                    font-weight: bold;
                    height: 75px; width: 100%;
                    border: 1px solid #bbb;
                    -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;
                }

                .progress {
                    height: 75px;
                }

                .trophy {
                    font-size: 50px;
                }
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            @if(!Auth::check())
                <div class="navicon">
                    <div id="login-text"><a href="/login">Login</a></div>
                    <div id="login-icon"><a href="/login"><i class="fa fa-sign-in"></i></a></div>
                </div>
            @else
                @if(Auth::user()->is('admin') || Auth::user()->is('editor'))
                    <div class="navicon">
                        <div id="create-text"><a href="/workout/create">Create Workout</a></div>
                        <div id="create-icon"><a href="/workout/create"><i class="fa fa-plus"></i></a></div>
                    </div>
                @endif
                <div class="navicon">
                    <div id="logout-text"><a href="/logout">Logout</a></div>
                    <div id="logout-icon"><a href="/logout"><i class="fa fa-sign-out"></i></a></div>
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

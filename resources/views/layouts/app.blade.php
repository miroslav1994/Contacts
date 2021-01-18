<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 400px;
            position: fixed;
            z-index: 2;
            top: 0;
            right: 0;
            background-color: #F4F4F4;
            overflow-x: hidden;
            padding-top: 120px;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .main {
            margin-left: 160px; /* Same as the width of the sidenav */
            font-size: 28px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>
</head>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js" integrity="sha512-2AL/VEauKkZqQU9BHgnv48OhXcJPx9vdzxN1JrKDVc4FPU/MEE/BZ6d9l0mP7VmvLsjtYwqiYQpDskK9dG8KBA==" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    $( document ).ready(function() {
        function fieldModel(){
            var self = this;
            var noTracker = 1;
            self.myFieldList2 = ko.observableArray([
                {label_pt : "Phone type 1", phone_type:"phone_type1",
                 label_p : "Phone 1", phone:"phone1"}]);
            self.myFieldList = ko.observableArray([
                {label_fn : "First name 1", fname : "first_name1",
                 label_ln : "Last name 1",  lname:"last_name1", foreach: self.myFieldList2
                }]);

            self.removeField = function(dynamicField){
                self.myFieldList.remove(dynamicField);
            }
            self.removeField2 = function(dynamicField){
                self.myFieldList2.remove(dynamicField);
            }

            self.addField = function() {
                noTracker++;
                self.myFieldList.push({label_fn : "First name "+ noTracker, fname : "first_name"+ noTracker,
                    label_ln : "Last name " + noTracker, lname : "last_name"+ noTracker,
                    label_pt : "Phone type " + noTracker, phone_type:"phone_type"+noTracker,
                    label_p : "Phone " + noTracker, phone:"p" + noTracker });
            }
            self.addField2 = function() {
                noTracker++;
                self.myFieldList2.push({
                    label_pt : "Phone type " + noTracker, phone_type:"phone_type"+noTracker,
                    label_p : "Phone " + noTracker, phone:"p" + noTracker });
            }
        }
        ko.applyBindings(fieldModel);
    });

</script>
<body>
    <div id="app">
        @include('inc.navbar')
        @include('inc.messages')
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li><br />
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

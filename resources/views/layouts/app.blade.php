<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title') @yield('title') - @endif {{ config('app.name', 'Shipsoftware') }}
    </title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a><br>
                </div>
                <div id="app-navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        {{-- <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li> --}}
                    </ul>
                    @auth
                        <!-- User links -->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->FirstName }} {{ Auth::user()->LastName }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ trans('auth.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <div class="container">
            <div class="content">
                @yield('content')
                <div id="push"></div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <p>&#169; {{ config('app.name') }}</p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAK8bzrVV9-fH72e3jyXSSjsWkW5bpduok&callback=initMap"></script>
    @auth
        @hasSection('scripts')
            @yield('scripts')
        @endif
        {{--<script type="text/javascript">--}}
            {{--// Init kompassi--}}
            {{--$(document).ready(function() {--}}
                {{--//draw(0);--}}
            {{--});--}}

            {{--// Get ships into listbox--}}
            {{--get_ships();--}}

            {{--$('#henkiloFormi').submit(function(ev) {--}}
                {{--ev.preventDefault();--}}
                {{--$('#txtSotu').removeAttr("disabled");--}}
                {{--var formData = new FormData($(this)[0]);--}}

                {{--$.ajax({--}}
                    {{--type: $(this).attr('method'),--}}
                    {{--url: $(this).attr('action'),--}}
                    {{--data: formData,--}}
                    {{--contentType: false,--}}
                    {{--processData: false,--}}
                    {{--success: function(data) {--}}
                        {{--alert(data);--}}
                        {{--$('#henkiloModal').modal('hide');--}}
                        {{--haeMiehisto();--}}
                        {{--return true;--}}
                    {{--},--}}
                    {{--error: function(data) {--}}
                        {{--if (data.responseText == '') {--}}
                            {{--alert('PHP koodissa jokin iso vika.');--}}
                        {{--} else {--}}
                            {{--alert(data.responseText);--}}
                        {{--}--}}
                        {{--return false;--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--</script>--}}
    @endauth
</body>
</html>

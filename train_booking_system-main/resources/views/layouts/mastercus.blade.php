<!-- customer.master.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('rtg_icon.png') }}" type="image/png">

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/lightpick@1.6.2/lightpick.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightpick@1.6.2/css/lightpick.min.css">
        <link href="{{ asset('sbadmin2/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        @vite(['resources/js/app.js'])

        <style>
            .uper {
                margin-top: 100px;
            }
            .set-right{
                right: 0px;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <!-- Nav bar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container-md">
                    <!--Logo-->
                    <a class="navbar-brand" href="{{ route('cus.search.schedule') }}">
                        <svg t="1710685911127" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1670" width="32" height="32"><path d="M519.04 224H96v400c0 97.28 78.72 176 176 176h528c70.4 0 128-57.6 128-128v-39.04c0-225.28-183.68-408.96-408.96-408.96z m156.16 256c17.92 17.92 35.2 57.6 46.72 92.8l-129.92-1.92c-34.56-1.28-66.56-15.36-87.68-39.04-8.96-10.24-16-20.48-21.12-33.28-2.56-6.4-5.76-12.16-8.96-18.56h200.96z m113.92 94.08a458.88 458.88 0 0 0-36.48-94.08h74.24c14.72 29.44 25.6 61.44 31.36 95.36l-69.12-1.28z m-4.48-158.08H437.76c-39.04-58.88-81.28-99.84-120.96-128H518.4c108.16 0 202.88 50.56 266.24 128z m15.36 320H272c-61.44 0-112-50.56-112-112V288h3.84c12.8 1.92 165.12 28.16 260.48 236.16 7.04 17.92 17.92 35.2 32 50.56 33.28 36.48 81.92 58.88 133.76 60.16l228.48 5.12h45.44v32c0 35.2-28.8 64-64 64zM96 864h832v64h-832zM96 96h435.2v64H96z" fill="#1296db" p-id="1671"></path></svg>
                        RTG
                    </a>
                    <!--End Logo-->

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarColor01">

                        <!--Left side nav-bar - nav-link -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cus.search.schedule') }}">View Train Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cus.map') }}">View Train Map</a>
                            </li>
                            @if($user)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cus.booking.search.schedule') }}">Booking</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route("cus.feedback") }}">Feedback</a>
                                </li>
                            @endIf
                        </ul>
                        <!--End Left side nav-bar - nav-link -->

                        <!--Right side navbar - cart && user -->
                        <div class="set-right">
                            <ul class="navbar-nav me-auto">
                                @if($user)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link d-inline-flex ms-3" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg t="1646278750138" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6511" width="32" height="32"><path d="M512 74.666667C270.933333 74.666667 74.666667 270.933333 74.666667 512S270.933333 949.333333 512 949.333333 949.333333 753.066667 949.333333 512 753.066667 74.666667 512 74.666667z m0 160c70.4 0 128 57.6 128 128s-57.6 128-128 128-128-57.6-128-128 57.6-128 128-128z m236.8 507.733333c-23.466667 32-117.333333 100.266667-236.8 100.266667s-213.333333-68.266667-236.8-100.266667c-8.533333-10.666667-10.666667-21.333333-8.533333-32 29.866667-110.933333 130.133333-187.733333 245.333333-187.733333s215.466667 76.8 245.333333 187.733333c2.133333 10.666667 0 21.333333-8.533333 32z" p-id="6512" fill="#8a8a8a"></path></svg>                                
                                            <span class="ms-1 pt-2 small">{{ $user->name }}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ route('cus.profilemenu') }}">Profile</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('cus.booking.filter', ['status' => 'all']) }}">My Booking</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('cus.logout') }}">LogOut</a>
                                        </div>
                                    </li>
                                @else
                                    <a class="nav-link d-inline-flex ms-3" href="{{ route('cus.login') }}">Login</a>
                                @endif
                            </ul>
                        </div>
                        <!--End Right side navbar user -->

                    </div>
                </div>
            </nav>
            <!--End Nav bar -->
            <div class="container uper">
                @yield('content')
            </div>
        </div>
    </body>
</html>

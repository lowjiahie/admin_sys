<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
            body {
                background-color: #f8f9fa;
            }
            .center-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh; /* Full viewport height */
            }
            .custom-container {
                max-width: 400px; /* Maximum width for content */
                padding: 20px;
                background-color: #ffffff; /* White background for container */
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow effect */
            }
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }
            .btn-primary:hover {
                background-color: #0069d9;
                border-color: #0062cc;
            }
        </style>
    </head>
    <body>
        <div class="center-container">
            <div class="custom-container">
                <h1 class="mb-3">Unauthorized Access</h1>
                <p class="lead mb-4">You are not authorized to access this page.</p>
                <a href="{{ route('cus.search.schedule') }}" class="btn btn-primary">Go to Home</a>
            </div>
        </div>
    </body>
</html>
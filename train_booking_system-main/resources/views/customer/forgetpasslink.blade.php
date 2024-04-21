
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
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h3 class="card-title">RTG Reset Password</h3>
                        </div>
                        <div class="card-body">
                            @if (isset($error))
                                <div class="alert alert-danger">
                                    {{ $error }} <a href="{{ route("cus.login") }}" class="mt-2 text-center">back to login?</a>
                                </div>
                            @endif

                            @if(isset($userp))
                                <form method="POST" action="{{ route('cus.forgetpassword.link.submit') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label"></label>
                                        <label class="form-label">{{ $userp->email }}</label>
                                        <input type="hidden" name="id" value="{{ $userp->id }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password:</label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" class="form-control">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                                                <i id="eye1" class="fas fa-eye" data-value="true"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password:</label>
                                        <div class="input-group">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                                                <i id="eye2" class="fas fa-eye" data-value="true"></i>
                                            </button>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-dark btn-block">Reset Password</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        const togglePassword1 = document.querySelector('#togglePassword1');
        const togglePassword2 = document.querySelector('#togglePassword2');
        const password = document.querySelector('#password');
        const password_confirmation = document.querySelector('#password_confirmation');
    
        togglePassword1.addEventListener('click', function (e) {
            // toggle the type attribute
            const oldtype = password.getAttribute('type');
            const type = oldtype === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye icon
    
            var faeye = document.getElementById("eye1");
    
            if(oldtype === "text"){
                faeye.classList.remove('fa-eye-slash');
                faeye.classList.add('fa-eye');
            }
    
            if(oldtype === "password"){
                faeye.classList.remove('fa-eye');
                faeye.classList.add('fa-eye-slash');
            }
        });
    
        togglePassword2.addEventListener('click', function (e) {
            // toggle the type attribute
            const oldtype = password_confirmation.getAttribute('type');
            const type = oldtype === 'password' ? 'text' : 'password';
            password_confirmation.setAttribute('type', type);
            // toggle the eye icon
    
            var faeye = document.getElementById("eye2");
    
            if(oldtype === "text"){
                faeye.classList.remove('fa-eye-slash');
                faeye.classList.add('fa-eye');
            }
    
            if(oldtype === "password"){
                faeye.classList.remove('fa-eye');
                faeye.classList.add('fa-eye-slash');
            }
        });
    </script>
</html>
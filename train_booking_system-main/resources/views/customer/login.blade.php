@extends('layouts.mastercus')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">RTG Login</h3>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('cus.submit.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i id="eye" class="fas fa-eye" data-value="true"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-block">Login</button>
                            <a href="{{ route('cus.register') }}" class="mt-2 text-center">register?</a>
                            <a href="{{ route('cus.forgetpassword') }}" class="mt-2 text-center">forget password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const oldtype = password.getAttribute('type');
        const type = oldtype === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye icon

        var faeye = document.getElementById("eye");

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


@endsection
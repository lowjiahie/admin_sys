@extends('layouts.mastercus')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">RTG Register</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('cus.register.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                        <div class="mb-3">
                            <label for="phone_num" class="form-label">Phone Number:</label>
                            <input type="text" id="phone_num" name="phone_num" class="form-control">
                            @error('phone_num')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-block">Register</button>
                            <a href="{{ route("cus.login") }}" class="mt-2 text-center">back to login?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
@endsection
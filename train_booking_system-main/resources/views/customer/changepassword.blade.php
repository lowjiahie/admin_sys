@extends('layouts.mastercus')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">RTG Reset Password</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('cus.changepassword.submit') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Current Password:</label>
                            <div class="input-group">
                                <input type="password" id="old_password" name="old_password" class="form-control">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                                    <i id="eye1" class="fas fa-eye" data-value="true"></i>
                                </button>
                            </div>
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password:</label>
                            <div class="input-group">
                                <input type="password" id="new_password" name="new_password" class="form-control">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                                    <i id="eye2" class="fas fa-eye" data-value="true"></i>
                                </button>
                            </div>
                            @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password:</label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword3">
                                    <i id="eye3" class="fas fa-eye" data-value="true"></i>
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
                </div>
            </div>
        </div>
    </div>
</div>
<script>
const togglePassword1 = document.querySelector('#togglePassword1');
const togglePassword2 = document.querySelector('#togglePassword2');
const togglePassword3 = document.querySelector('#togglePassword3');
const password = document.querySelector('#old_password');
const new_password = document.querySelector("#new_password");
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
    const oldtype = new_password.getAttribute('type');
    const type = oldtype === 'password' ? 'text' : 'password';
    new_password.setAttribute('type', type);
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

togglePassword3.addEventListener('click', function (e) {
    // toggle the type attribute
    const oldtype = password_confirmation.getAttribute('type');
    const type = oldtype === 'password' ? 'text' : 'password';
    password_confirmation.setAttribute('type', type);
    // toggle the eye icon

    var faeye = document.getElementById("eye3");

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
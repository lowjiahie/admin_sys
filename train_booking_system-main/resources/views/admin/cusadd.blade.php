@extends('layouts.masteradmin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Add User</h5>
        </div>
        <div class="card-body">
            <!-- Add Form -->
            <form action="{{ route("admin.cus.add.submit") }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
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
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
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
                <div class="form-group">
                    <label for="phone_num">Phone Number:</label>
                    <input type="text" id="phone_num" name="phone_num" class="form-control">
                    @error('phone_num')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Record</button>
            </form>
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
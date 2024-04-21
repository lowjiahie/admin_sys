@extends('layouts.masteradmin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Update User Password</h5>
        </div>
        <div class="card-body">
            <!-- Add Form -->
            <form action="{{ route("admin.staff.password.update.submit") }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $usere->id }}">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <label for="emailvalue" class="form-label">{{ $usere->email }}</label>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">User Type:</label>
                    <label for="typevalue" class="form-label">{{ $usere->user_type_name }}</label>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <label for="name" class="form-label">{{ $usere->name }}</label>
                </div>
                <div class="mb-3">
                    <label for="phone_num" class="form-label">Phone Number:</label>
                    <label for="name" class="form-label">{{ $usere->phone_num }}</label>
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
                <button type="submit" class="btn btn-primary">Update Record</button>
            </form>
        </div>
    </div>
    <script>
        const togglePassword2 = document.querySelector('#togglePassword2');
        const togglePassword3 = document.querySelector('#togglePassword3');
        const password = document.querySelector('#old_password');
        const new_password = document.querySelector("#new_password");
        const password_confirmation = document.querySelector('#password_confirmation');
        
        
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
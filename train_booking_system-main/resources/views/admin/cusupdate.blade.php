@extends('layouts.masteradmin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Update User</h5>
        </div>
        <div class="card-body">
            <!-- Add Form -->
            <form action="{{ route("admin.cus.update.submit") }}" method="POST">
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
                    <input type="text" id="name" name="name" class="form-control" value="{{ $usere->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone_num" class="form-label">Phone Number:</label>
                    <input type="text" id="phone_num" name="phone_num" class="form-control" value="{{ $usere->phone_num }}">
                    @error('phone_num')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Y" {{ $usere->status == "Y"? "selected":"" }}>Active</option>
                        <option value="N" {{ $usere->status == "N"? "selected":"" }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Record</button>
            </form>
        </div>
    </div>
@endsection
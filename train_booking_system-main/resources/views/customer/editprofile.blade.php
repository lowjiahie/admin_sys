@extends('layouts.mastercus')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">RTG Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('cus.edit.profile.submit') }}">
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
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-block">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.mastercus')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">RTG Profile Menu</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="mb-3 text-center">
                        <a href="{{ route('cus.edit.profile') }}" class="btn btn-dark">Edit Profile</a>
                    </div>
                    <div class="mb-3 text-center">
                        <a href="{{ route('cus.changepassword') }}" class="btn btn-dark">Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
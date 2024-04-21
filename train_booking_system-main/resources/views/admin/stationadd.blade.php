@extends('layouts.masteradmin')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Add Station</h5>
        </div>
        <div class="card-body">
            <!-- Add Form -->
            <form action="{{ route("admin.station.add.submit") }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
                </div>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Y">Active</option>
                        <option value="N">Inactive</option>
                    </select>
                </div>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="submit" class="btn btn-primary">Add Record</button>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.masteradmin')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Update Station</h5>
        </div>
        <div class="card-body">
            <!-- Add Form -->
            <form action="{{ route("admin.station.update.submit") }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $station->id }}">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $station->name }}" required>
                </div>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="4" required>{{ $station->address }}</textarea>
                </div>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Y" {{ $station->status == 'Y' ? 'selected' : '' }}>Active</option>
                        <option value="N" {{ $station->status == 'N' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="submit" class="btn btn-primary">Update Record</button>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.masteradmin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Update Train</h5>
        </div>
        <div class="card-body">
            <!-- Add Form -->
            <form action="{{ route("admin.train.update.submit") }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $train->id }}">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $train->name }}" required>
                </div>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="plate_no">Plate No:</label>
                    <input type="text" class="form-control" id="plate_no" name="plate_no"  value="{{ $train->plate_no }}" required>
                </div>
                @error('plate_no')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Y" {{ $train->status == 'Y' ? 'selected' : '' }}>Active</option>
                        <option value="N" {{ $train->status == 'N' ? 'selected' : '' }}>Inactive</option>
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
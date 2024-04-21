@extends('layouts.masteradmin')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Update Feedback</h5>
        </div>
        <div class="card-body">
            <!-- Add Form -->
            <form action="{{ route("admin.feedback.update.submit") }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $feedback->id }}">
                <div class="form-group">
                    <label for="name">Title:</label>
                    <label class="form-control">{{ $feedback->title }}</label>
                </div>
                <div class="form-group">
                    <label for="name">Content:</label>
                    <label class="form-control">{{ $feedback->content }}</label>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Y" {{ $feedback->status == 'Y' ? 'selected' : '' }}>Active</option>
                        <option value="N" {{ $feedback->status == 'N' ? 'selected' : '' }}>Inactive</option>
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
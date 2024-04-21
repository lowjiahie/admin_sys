@extends('layouts.mastercus')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">RTG Feedback Form</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('cus.feedback.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Feedback Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Feedback Content</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
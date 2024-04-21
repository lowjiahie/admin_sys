@extends('layouts.masteradmin')

@section('content')
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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Feedback Listing</h5>
    </div>
    <div class="card-body">
        <table class="display datatable" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>From User</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->title }}</td>
                    <td>{{ $feedback->content }}</td>
                    <td>{{ $feedback->status }}</td>
                    <td>{{ $feedback->user->email }}</td>
                    <td>              
                        <!-- Update Icon -->
                        <a href="{{ route('admin.feedback.update', ['id' => $feedback->id]) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Update
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
@endsection
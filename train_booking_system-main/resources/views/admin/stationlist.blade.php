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
        <h5 class="m-0 font-weight-bold text-primary">Station Listing</h5>
    </div>
    <div class="card-body">
        <form method="get" class="form-inline">
            <!-- Add Icon -->
            <a href="{{ route("admin.station.add") }}" class="btn btn-success me-2">
                <i class="fas fa-plus"></i> Add
            </a>

            <a href="{{ route("admin.map") }}" class="btn btn-success me-2">
                <i class="fas fa-edit"></i> Update Station Map
            </a>
            <input class="form-control mr-sm-2" name="searchtext" type="text" placeholder="Search by name"
                aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="nameSearchBtn">Search</button>
        </form>
        <table class="display datatable" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_stations as $station)
                <tr>
                    <td>{{ $station->name }}</td>
                    <td>{{ $station->address }}</td>
                    <td>{{ $station->status }}</td>
                    <td>              
                        <!-- Update Icon -->
                        <a href="{{ route('admin.station.update', ['id' => $station->id]) }}" class="btn btn-primary">
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
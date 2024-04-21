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
        <h5 class="m-0 font-weight-bold text-primary">Train Route Listing</h5>
    </div>
    <div class="card-body">
        <form method="get" class="form-inline">
            <!-- Add Icon -->
            <a href="{{ route("admin.trainroute.add") }}" class="btn btn-success me-2">
                <i class="fas fa-plus"></i> Add
            </a>
            {{-- <input class="form-control mr-sm-2" name="searchtext" type="text" placeholder="Search by plate no"
                aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="nameSearchBtn">Search</button> --}}
        </form>
        <table class="display datatable" style="width:100%">
            <thead>
                <tr>
                    <th>Train Name</th>
                    <th>Train Plate No</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure Datetime</th>
                    <th>Price</th>
                    <th>Total Seats</th>
                    <th>Current Available Seats</th>
                    <th>Status</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_trainroutes as $train_route)
                <tr>
                    <td>{{ $train_route->train->name }}</td>
                    <td>{{ $train_route->train->plate_no }}</td>
                    <td>{{ $train_route->departureStation->name }}</td>
                    <td>{{ $train_route->arrivalStation->name }}</td>
                    <td>{{ $train_route->departure_date_time }}</td>
                    <td>{{ $train_route->price }}</td>
                    <td>{{ $train_route->total_seats }}</td>
                    <td>{{ $train_route->available_seats }}</td>
                    <td>{{ $train_route->status }}</td>
                    <td>              
                        <!-- Update Icon -->
                        <a href="{{ route('admin.trainroute.update', ['id' => $train_route->id]) }}" class="btn btn-primary">
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
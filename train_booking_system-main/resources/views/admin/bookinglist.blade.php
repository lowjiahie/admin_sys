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
        <h5 class="m-0 font-weight-bold text-primary">Booking Listing</h5>
    </div>
    <div class="card-body">
        {{-- <form method="get" class="form-inline">
            <!-- Add Icon -->
            <a href="{{ route("admin.booking.add") }}" class="btn btn-success me-2">
                <i class="fas fa-plus"></i> Add
            </a>
            <input class="form-control mr-sm-2" name="searchtext" type="text" placeholder="Search by name"
                aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="nameSearchBtn">Search</button>
        </form> --}}
        <div clas="table-responsive">
            <table class="display datatable table " style="width:100%">
                <thead>
                    <tr>
                        <th>Booking No</th>
                        <th>Booking Contact</th>
                        <th>From User Email</th>
                        <th>Total Booking Seats</th>
                        <th>Total Fare</th>
                        <th>Depart & Arrival Station</th>
                        <th>Platform</th>
                        <th>Departure Datetime</th>
                        <th>Booking Datetime</th>
                        <th>Status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_no }}</td>
                        <td>{{ $booking->name }} ({{ $booking->phone_num }})</td>
                        <td>{{ $booking->user->email }}</td>
                        <td>{{ $booking->total_seats }}</td>
                        <td>{{ $booking->total_fare }}</td>
                        <td>{{ $booking->route->departureStation->name }} to {{ $booking->route->arrivalStation->name }}</td>
                        <td>{{ $booking->route->platform }}</td>
                        <td>{{ $booking->route->departure_date_time }}</td>
                        <td>{{ $booking->created_at }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>              
                            <!-- Update Icon -->
                            <a href="{{ route('admin.booking.update', ['id' => $booking->id]) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Update
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>
    
@endsection
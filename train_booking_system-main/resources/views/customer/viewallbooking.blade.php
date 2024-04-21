@extends('layouts.mastercus')

@section('content')
<div class="container mb-5">
    <h1>View Bookings</h1>
    <!-- Filter buttons -->
    <div class="btn-group mb-3" role="group" aria-label="Booking Status Filters">
        <a href="{{ route('cus.booking.filter', ['status' => 'all']) }}" class="btn btn-dark">All</a>
        <a href="{{ route('cus.booking.filter', ['status' => 'pending']) }}" class="btn btn-dark">Pending</a>
        <a href="{{ route('cus.booking.filter', ['status' => 'complete']) }}" class="btn btn-dark">Complete</a>
        <a href="{{ route('cus.booking.filter', ['status' => 'cancelled']) }}" class="btn btn-dark">Cancelled</a>
    </div>
    <!-- Bookings display area -->
    <div class="row">
        @if(!$bookings->isEmpty())
            @foreach($bookings as $booking)
                <div class="col-md-4">
                    <div class="card booking-card">
                        <div class="card-body">
                            <h5 class="card-title">Booking Name: <strong>{{ $booking->name }}</strong></h5>
                            <h5 class="card-title">Booking No: <strong>{{ $booking->booking_no }}</strong></h5>
                            <h5 class="card-title">Booking Status: <strong>{{ $booking->status }}</strong></h5>
                            <hr class="mb-2"/>
                            <p class="card-text">Departure Date Time: {{ $booking->route->departure_date_time }}</p>
                            <p class="card-text">Departure Station: {{ $booking->route->departureStation->name }}</p>
                            <p class="card-text">Arrival Station: {{ $booking->route->arrivalStation->name }}</p>
                            <p class="card-text">Platform: {{ $booking->route->platform }}</p>
                            <p class="card-text">Payment Method: {{  $booking->payment_type  }}</p>
                            <p class="card-text">Pax: {{ $booking->total_seats }}</p>
                            <p class="card-text">Booking Datetime: {{ $booking->created_at }}</p>
                            <p class="card-text">Total Price: RM{{ $booking->total_fare }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h5 class="text-muted">No Booking Yet</h5>
        @endIf
    </div>
</div>

@endsection;
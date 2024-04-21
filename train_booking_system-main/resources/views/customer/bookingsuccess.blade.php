@extends('layouts.mastercus')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success" role="alert">
                <h5 class="alert-heading">Booking Successful!</h5>
                <p>Your booking has been successfully completed.</p>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <div class="pt-2"><h5 class="card-title fw-bold">Booking Details</h5></div>
                        <div class="ms-auto"><a href="{{ route('cus.booking.filter', ['status' => 'all']) }}" class="btn btn-dark">View My Booking</a></div>
                    </div>
                    <hr/>
                    <p class="card-text">Booking No: <strong>{{ $booking->booking_no }}</strong></p>
                    <p class="card-text">Departure Date Time: {{ $booking->route->departure_date_time }}</p>
                    <p class="card-text">Departure Station: {{ $booking->route->departureStation->name }}</p>
                    <p class="card-text">Arrival Station: {{ $booking->route->arrivalStation->name }}</p>
                    <p class="card-text">Platform: {{ $booking->route->platform }}</p>
                    <p class="card-text">Pax: {{ $booking->total_seats }}</p>
                    <p class="card-text">Total Price: RM{{  $booking->total_fare  }}</p>
                    <p class="card-text">Payment Method: {{  $booking->payment_type  }}</p>

                    @if ($booking->payment_type == "paypal")
                        <p class="card-text text-muted mt-3">Please show the booking no <strong>{{ $booking->booking_no }}</strong> to collect your ticket token at the counter.</p>
                    @endif

                    @if ($booking->payment_type == "cash")
                        <p class="card-text text-muted mt-3">Please show the booking no <strong>{{ $booking->booking_no }}</strong> to pay and collect your ticket token at the counter.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
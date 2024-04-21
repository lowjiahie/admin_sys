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
        <h5 class="m-0 font-weight-bold text-primary">Monthly Sales Report</h5>
    </div>
    <div class="card-body">
        <form method="get" class="form-inline">
            <label class="me-2">Select a Month and Year : </label>
            <input class="form-control me-2" type="month" id="searchtext" name="searchtext" min="2018-01" value="{{ $searchtext }}" />
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="nameSearchBtn">Search</button>
        </form>
        <div clas="table-responsive">
            <table class="display datatable table " style="width:100%">
                <thead>
                    <tr>
                        <th>Booking No</th>
                        <th>Booking Contact</th>
                        <th>From User Email</th>
                        <th>Depart & Arrival Station</th>
                        <th>Platform</th>
                        <th>Departure Datetime</th>
                        <th>Total Booking Seats</th>
                        <th>Total Fare (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_no }}</td>
                        <td>{{ $booking->name }} ({{ $booking->phone_num }})</td>
                        <td>{{ $booking->user->email }}</td>
                        <td>{{ $booking->route->departureStation->name }} to {{ $booking->route->arrivalStation->name }}</td>
                        <td>{{ $booking->route->platform }}</td>
                        <td>{{ $booking->route->departure_date_time }}</td>
                        <td>{{ $booking->total_seats }}</td>
                        <td>{{ $booking->total_fare }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Sum Fare (RM) :</td>
                        <td>{{ $total_sum_fare }}</td>
                    </tr>
                </tfoot>
            </table>
    </div>
</div>

    
@endsection
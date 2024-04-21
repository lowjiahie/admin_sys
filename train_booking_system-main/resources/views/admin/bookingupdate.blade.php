@extends('layouts.masteradmin')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Booking Station</h5>
        </div>
        <div class="card-body">
            <!-- Add Form -->
            <form action="{{ route("admin.booking.update.submit") }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $booking->id }}">
                <div class="form-group">
                    <label for="name">Booking No</label>
                    <label class="form-control">{{ $booking->booking_no }}</label>
                </div>
                <div class="form-group">
                    <label for="name">Booking Name</label>
                    <label class="form-control">{{ $booking->name }}</label>
                </div>

                <div class="form-group">
                    <label for="name">From User Email</label>
                    <label class="form-control">{{ $booking->user->email }}</label>
                </div>

                <div class="form-group">
                    <label for="name">Phone Num</label>
                    <label class="form-control">{{ $booking->phone_num }}</label>
                </div>


                <div class="form-group">
                    <label for="name">Total Booking Seats</label>
                    <label class="form-control">{{ $booking->total_seats }}</label>
                </div>

                <div class="form-group">
                    <label for="name">Total Fare</label>
                    <label class="form-control">{{ $booking->total_fare }}</label>
                </div>

                <div class="form-group">
                    <label for="name">Depart Station</label>
                    <label class="form-control">{{ $booking->route->departureStation->name }}</label>
                </div>

                <div class="form-group">
                    <label for="name">Arrival Station</label>
                    <label class="form-control">{{ $booking->route->arrivalStation->name }}</label>
                </div>

                <div class="form-group">
                    <label for="name">Platform</label>
                    <label class="form-control">{{ $booking->route->platform }}</label>
                </div>


                <div class="form-group">
                    <label for="name">Departure Datetime</label>
                    <label class="form-control">{{ $booking->route->departure_date_time }}</label>
                </div>
                
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="complete" {{ $booking->status == 'complete' ? 'selected' : '' }}>Complete</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
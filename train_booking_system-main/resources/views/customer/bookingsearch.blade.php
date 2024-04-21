@extends('layouts.mastercus')

@section('content')
<div class="container">
    <h2>Booking Train Schedule</h2>
    <form method="POST" action="{{ route('cus.submit.schedule') }}">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="" class="form-label">Origin Station</label>
                    <select class="form-control select-origin" name="origin">
                        <option></option>
                        @foreach($stations as $station)
                            <option value="{{ $station['id'] }}"  {{ old('origin') == $station['id'] ? 'selected' : '' }}>
                                {{ $station['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('origin')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-6">
                <label for="" class="form-label">Destination Station</label>
                <select class="form-control select-destination" name="destination">
                    <option></option>
                    @foreach($stations as $station)
                    <option value="{{ $station['id'] }}"  {{ old('destination') == $station['id'] ? 'selected' : '' }}>
                        {{ $station['name'] }}
                    </option>
                @endforeach
                </select>
                @error('destination')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="" class="form-label">Pax</label>
                    <input type="number" max="8" class="form-control" placeholder="pax" name="pax" value="{{ old('pax', 1) }}">
                </div>
                @error('pax')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="" class="form-label">Departure Date</label>
                    <input type="text" class="form-control" id="datepicker" placeholder="departure date" name="departure_date" value="{{ old('departure_date') }}"/>
                </div>
                @error('departure_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark">Search</button>
        </div>
        @csrf
    </form>
</div>

@if (session('train_routes'))
    <div class="container mb-5">
        @if(!session('train_routes')->isEmpty())
            <h1 class="mt-5 mb-4">Available Train Listing</h1>
        @else
            <p>No train routes found.</p>
        @endif
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach(session('train_routes') as $train_route)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        @if($train_route->available_seats > 0)
                            <p class="card-title"><span class="h5">{{ $train_route->train->name }} ({{ $train_route->train->plate_no }})</span> <span class="badge bg-dark">AVAILABLE</span></p>
                        @else
                            <p class="card-title"><span class="h5">{{ $train_route->train->name }} ({{ $train_route->train->plate_no }})</span> <span class="badge bg-dark">NOT AVAILABLE</span></p>
                        @endIf
                        <p class="card-text">Departure Date Time: {{ $train_route->departure_date_time }}</p>
                        <p class="card-text">Departure Station: {{ $train_route->departureStation->name}}</p>
                        <p class="card-text">Arrival Station: {{ $train_route->arrivalStation->name }}</p>
                        <p class="card-text">Total Seats: {{ $train_route->total_seats }}</p>
                        <p class="card-text">Platform: {{ $train_route->platform }}</p>
                        <p class="card-text">Price: RM{{ $train_route->price }}</p>
                        <p class="card-text">Currennt Available Seat: {{ $train_route->available_seats }}</p>

                        @if($train_route->available_seats > 0)
                            <div class="d-flex justify-content-end">
                                <form method="GET" action="{{ route('cus.booking.confirm') }}">
                                    <input type="hidden" name="pax" value="{{ old('pax', 1) }}">
                                    <input type="hidden" name="id" value="{{ $train_route->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">Book</button>
                                </form>
                                
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endif

<script>
$('.select-origin').select2({
  placeholder: "Select a Origin",
  allowClear: true
});

$('.select-destination').select2({
  placeholder: "Select a Destination",
  allowClear: true
});

var today = new Date();
var picker = new Lightpick({ 
    field: document.getElementById('datepicker'),
    minDate: today,
    format: 'YYYY-MM-DD'
});

document.getElementById('datepicker').addEventListener('keyup', function() {
    var inputDate = new Date(this.value);
    console.log(inputDate < today);
    if (inputDate < today) {
        alert('Please enter a date on or after today.');
        picker.setDate(today);
    }
});
</script>


@endsection
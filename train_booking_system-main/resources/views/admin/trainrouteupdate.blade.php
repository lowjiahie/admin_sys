@extends('layouts.masteradmin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Add Route Train</h5>
        </div>
        <div class="card-body">
            <!-- Add Form -->
            <form action="{{ route("admin.trainroute.update.submit") }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $trainroute->id }}">
                <div class="form-group">
                    <label for="train_id">Train:</label>
                    <select class="form-control select-train" name="train_id">
                        <option></option>
                        @foreach($trains as $train)
                            <option value="{{ $train['id'] }}" {{ $trainroute->train_id == $train['id'] ? 'selected' : '' }}>
                                {{ $train['name'] }} ({{ $train['plate_no'] }})
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('train_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="departure_station_id">Departure Station :</label>
                    <select class="form-control select-origin" name="departure_station_id">
                        <option></option>
                        @foreach($stations as $station)
                            <option value="{{ $station['id'] }}" {{ $trainroute->departure_station_id == $station['id'] ? 'selected' : '' }}>
                                {{ $station['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('departure_station_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="arrival_station_id">Arrival Station :</label>
                    <select class="form-control select-destination" name="arrival_station_id">
                        <option></option>
                        @foreach($stations as $station)
                            <option value="{{ $station['id'] }}" {{ $trainroute->   arrival_station_id == $station['id'] ? 'selected' : '' }}>
                                {{ $station['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('arrival_station_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="departure_date_time">Departure Date Time:</label>
                    <input type="datetime-local" class="form-control" id="datetimepicker1" name="departure_date_time" value="{{ $trainroute->departure_date_time }}">
                </div>
                @error('departure_date_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="platform">Platform:</label>
                    <select class="form-control" id="platform" name="platform" required>
                        <option value="A" {{ $trainroute->platform == "A" ? 'selected' : '' }}>Plaform A</option>
                        <option value="B" {{ $trainroute->platform == "B" ? 'selected' : '' }}>Plaform B</option>
                    </select>
                </div>
                @error('platform')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $trainroute->price }}"> 
                </div>
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="total_seats">Total Seats:</label>
                    <input type="number" class="form-control" id="total_seats" name="total_seats" value="{{ $trainroute->total_seats }}" disabled> 
                </div>
                @error('total_seats')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status">
                        <option value="Y" {{ $trainroute->status == "Y" ? 'selected' : '' }}>Active</option>
                        <option value="N" {{ $trainroute->status == "N" ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="submit" class="btn btn-primary">Add Record</button>
                
                @error('train_route_exist')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </form>
        </div>
    </div>
@endsection
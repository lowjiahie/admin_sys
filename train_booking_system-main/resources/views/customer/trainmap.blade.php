@extends('layouts.mastercus')

@section('content')
<style>
.train-road-vertical {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px; /* Adjust gap between stations and lines */
}

.station {
  width: 50%;
  height: 40px;
  background-color: #fff;
  border: 2px solid #333;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: bold;
}

.start {
  background-color: #81c784; /* Green color for start station */
}

.end {
  background-color: #f06292; /* Pink color for end station */
}

.line {
  width: 2px; /* Adjust line width */
  height: 20px; /* Adjust line height */
  background-color: #333;
}
</style>
<div class="container">
    <h2>View Train Map</h2>
    <div class="train-road-vertical mt-4 mb-5">
        @foreach($stations as $station)
            <div class="station">{{ $station->name }}</div>
            @if (!$loop->last)
                <div class="line"></div>
            @endif
        @endforeach
    </div>
</div>

@endsection
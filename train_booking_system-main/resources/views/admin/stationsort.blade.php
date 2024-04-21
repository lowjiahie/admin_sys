@extends('layouts.masteradmin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Update Station Map</h5>
    </div>
    <div class="card-body">
        <ul id="stationList" class="list-group">
            @foreach($stations as $station)
                <li class="list-group-item" data-id="{{ $station->id }}">{{ $loop->index + 1  }} - {{ $station->name }}</li>
            @endforeach
        </ul>
        
        <button class="btn btn-primary" id="updateButton">Update</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
    const stationList = document.getElementById('stationList');
    const updateButton = document.getElementById('updateButton');
    let updatedOrder = [];

    new Sortable(stationList, {
        animation: 150,
        onEnd: function (evt) {
            const items = Array.from(stationList.children);
            updatedOrder = items.map((item, index) => ({
                id: item.getAttribute('data-id'),
                order: index + 1, // Add 1 to start order from 1 instead of 0
            }));
        }
    });

    updateButton.addEventListener('click', function () {
        let newData = {
            items : updatedOrder,
        };

        // Construct the request object
        let request = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Specify JSON content type
                'Accept': 'application/json', // Specify JSON accept type
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(newData) // Convert data object to JSON string
        };

        fetch('{{ route('admin.map.update') }}', request)
            .then(response => {
                // Handle the response
                if (response.ok) {
                    return response.json(); // Parse response body as JSON
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                if(data.success){
                    alert("Success Updated the Station Map Order");
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error); // Handle errors
            });
    });
</script>


@endsection


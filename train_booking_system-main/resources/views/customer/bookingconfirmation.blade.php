@extends('layouts.mastercus')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4">Order Confirmation</h2>
                    <div class="mb-3">
                        <h5>Contact Information</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Name: {{ $user->name }}</li>
                            <li class="list-group-item">Phone Number: {{ $user->phone_num }}</li>
                            <li class="list-group-item">Email: {{ $user->email }}</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <h5>Train Details</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Train Name: {{ $train_route->train->name }}</li>
                            <li class="list-group-item">Plate Number: {{ $train_route->train->plate_no }}</li>
                            <!-- Add more train details here as needed -->
                        </ul>
                    </div>
                    <div class="mb-3">
                        <h5>Order Details</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Platform: {{ $train_route->platform }}</li>
                            <li class="list-group-item">Departure Station: {{ $train_route->departureStation->name }}</li>
                            <li class="list-group-item">Arrival Station: {{ $train_route->arrivalStation->name}}</li>
                            <li class="list-group-item">Departure Date & Time: {{ $train_route->departure_date_time }}</li>
                            <li class="list-group-item">Booking Ticket Qty: {{ $pax }}</li>
                            <li class="list-group-item">Price Per Ticket: RM{{ $train_route->price }}</li>
                            <li class="list-group-item">Sub Totol: RM{{ number_format($sub_total,2) }}</li>
                            <li class="list-group-item">SST GovTax 6%: RM{{ number_format($sst_price,2)  }}</li>
                            <li class="list-group-item">Total Price: RM{{ number_format($total_price,2) }}</li>
                        </ul>
                    </div>
                    <div class="container mb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="paymentMethod" class="form-label">Payment Method</label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" id="paymentMethod">
                                            <option value="paypal" selected>PayPal</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="paypalButton">
                        <div class="text-center">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                    
                    <div id="cashMessage" style="display: none;">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" id="cashbtn" onclick="addBooking()" type="button">Book Now</button>
                        </div>
                        <!-- Message to display when cash is selected -->
                        <p class="h5 text-muted text-center mt-3">Please pay with cash at the counter</p>
                    </div>

                    <p class="h5 text-muted mt-3">*This Booking is Non-refundable and Free-sitting</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=ARVu-qcQ00dPDoZ40w2jhtzPO7PJQZ0uck00k3dRE0KvwxJ-MoBdiieZljEd1tnNPlXE46Y1Dpr6BaVi&currency=MYR"></script>
<script>
    document.getElementById('paymentMethod').addEventListener('change', function() {
        var selectedOption = this.value;
        var paypalButton = document.getElementById('paypalButton');
        var cashMessage = document.getElementById('cashMessage');

        if (selectedOption === 'paypal') {
            paypalButton.style.display = 'block';
            cashMessage.style.display = 'none';
        } else if (selectedOption === 'cash') {
            paypalButton.style.display = 'none';
            cashMessage.style.display = 'block';
        }
    });
</script>

<script>
    function addBooking(){
        let newData = {
            id: {{ $train_route->id }},
            pax: {{ $pax }},
            payment_method: document.getElementById('paymentMethod').value
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

        fetch('{{ route('cus.create.booking') }}', request)
            .then(response => {
                // Handle the response
                if (response.ok) {
                    return response.json(); // Parse response body as JSON
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                if(data){
                    window.location.href = '{{ route('cus.booking.success') }}';  
                }

            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error); // Handle errors
            });
    }
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({
        style: {
            layout: 'horizontal'
        },
        // Call your server to set up the transaction
        createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [
                {
                  amount: {
                    value: {{ number_format($total_price,2) }}
                  },
                },
              ],
            });
        },

        // Call your server to finalize the transaction
        onApprove: function(data, actions) {
            addBooking();
        },

        onCancel: function(data, actions) {
            console.log("You have cancel payment");
        },

        onError: function(err) {
            console.log("Paypal Error !!");
        }

    }).render('#paypal-button-container');
</script>


@endsection
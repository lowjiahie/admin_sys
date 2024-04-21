<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Station;
use App\Enums\StatusEnum;
use App\Models\TrainRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Enums\BookingStatusEnum;
use App\Enums\BookingTrxTypeEnum;
use App\Models\BookingTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function search_schedule(){
        
        $station = new Station();
        $stations = $station->getStations(null);

        return view("customer.search")->with('stations',$stations);
    }

    public function booking_search_schedule(){
        
        $station = new Station();
        $stations = $station->getStations(null);

        return view("customer.bookingsearch")->with('stations',$stations);
    }

    public function submit_schedule(Request $request){
        $rules = [
            'origin' => 'required',
            'destination' => 'required',
            'pax' => 'required|numeric|between:1,8',
            'departure_date' => 'required|date',
        ];
        
        // Create a validator instance
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return back()
                ->withErrors($validator) // Pass validation errors to the view
                ->withInput(); // Keep the old form input values
        }

        $departure_datetime_start = Carbon::createFromFormat('Y-m-d', $request->departure_date)->startOfDay();
        $departure_datetime_end = Carbon::createFromFormat('Y-m-d', $request->departure_date)->endOfDay();
        $origin_id = $request->origin;
        $destination_id = $request->destination;
        $pax = $request->pax;
        $train_route = new TrainRoute();

        $train_routes = $train_route->getTrainRoute($origin_id,$destination_id, $departure_datetime_start, $departure_datetime_end);

        $train_routes = $train_route->getTrainRouteMatchWithOrderQty($train_routes,$pax);

        return back()->with('train_routes', $train_routes)->withInput();
    }

    public function booking_confirm(Request $request){
        $train_route_id = $request->id;
        $order_pax = $request->pax;
        $train_route = TrainRoute::findOrFail($train_route_id);

        if($train_route && $train_route->available_seats >= $order_pax){
            $subtotal = $train_route->price * $order_pax;
            $sst_price = ($train_route->price * $order_pax)*0.06;
            return view("customer.bookingconfirmation")->with([
                'train_route' => $train_route,
                'sub_total' => $subtotal,
                'total_price'=> $subtotal + $sst_price,
                'sst_price' => $sst_price,
                'pax'=> $order_pax
            ]);
        }else{
            return redirect()->back()->with('error', 'Not Available Train Route');
        }
    }

    public function create_booking(Request $request){
        $train_route_id = $request->id;
        $order_pax = $request->pax;
        $payment_method = $request->payment_method;
        $user = session("user");

        $train_route = TrainRoute::findOrFail($train_route_id);

        if(!Session::has('tempBookingNo')){
            $tempBookingNo = 'rtg-' . uniqid();
            $request->session()->put('tempBookingNo', $tempBookingNo);
        }

        if($train_route && $train_route->available_seats >= $order_pax && Session::has('tempBookingNo')){
            $booking = Booking::create([
                'booking_no' => $request->session()->get('tempBookingNo'),
                'name' => $user->name,
                'phone_num' => $user->phone_num,
                'status' => BookingStatusEnum::PENDING,
                'payment_type' => $payment_method,
                'total_seats' => $order_pax,
                'total_fare' => ($train_route->price*$order_pax)*1.06,
                'user_id'=> $user->id,
                'train_route_id' =>$train_route->id,
            ]);

            BookingTransaction::create([
                'trx_type' => BookingTrxTypeEnum::OUT,
                'trx_in'=> 0,
                'trx_out' => $order_pax,
                'status'=> StatusEnum::ACTIVE,
                'booking_id' => $booking->id,
                'train_route_id' => $train_route->id,
            ]);

            if($booking->id > 0){
                request()->session()->forget('tempBookingNo');
                $request->session()->put('bookingId', $booking->id);
            }

            return response()->json(['booking' => $booking], 201);
        }

        return response()->json(['error' => 'Failed to create booking'], 400);
    }


    public function booking_success(){
        $user = session("user");
        $booking_id = session("bookingId");
        $booking = new Booking();

        $bookingResult = $booking->user_booking($booking_id, $user->id);
        return view("customer.bookingsuccess")->with('booking',$bookingResult);
    }


    public function booking_filter($status){
        $booking = new Booking();
        $user = session("user");

        switch (strtolower($status)) {
            case "pending":
            case "complete":
            case "cancelled":
                break;
    
            default:
                $status = "all";
                break;
        }

        $bookings = $booking->user_bookings_based_on_status($user->id, strtolower($status));

        return view("customer.viewallbooking")->with("bookings",$bookings);
    }

    public function show(Request $request){
        $booking = new Booking();
        $all_bookings = Booking::with(['route','route.train', 'route.departureStation', 'route.arrivalStation','user'])->get();
        return view("admin.bookinglist")->with("all_bookings",$all_bookings);
    }

   public function update($id){
        $booking = Booking::with(['route','route.train', 'route.departureStation', 'route.arrivalStation','user'])->find($id);

        if(!$booking){
            return back()->with("error", "Record Not Found");
        }

        return view("admin.bookingupdate")->with("booking", $booking);
    }

    public function update_submit(Request $request){
        $booking = Booking::with(['route','user'])->find($request->id);
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,complete,cancelled',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $booking->status = $request->status;
        $booking->save(); // Save the changes

        return redirect()->route("admin.booking.list")->with("success","Successfully update a booking status");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Train;
use App\Models\Station;
use App\Enums\StatusEnum;
use App\Models\TrainRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Enums\BookingTrxTypeEnum;
use App\Models\BookingTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class TrainRouteController extends Controller
{
    public function show(Request $request){
        $trainroute = new TrainRoute();
        $all_trainroutes = $trainroute->getAllTrainRoute();

        return view("admin.trainroutelist")->with("all_trainroutes",$all_trainroutes);
    }

    public function add(){
        $train = new Train();
        $station = new Station();
        $stations = $station->getStations(null);
        $trains = $train->getAllTrains();

        return view("admin.trainrouteadd")->with(['stations'=>$stations, 'trains'=>$trains]);
    }

    public function add_submit(Request $request){
        $request->validate([
            'departure_date_time' => 'required',
            'total_seats' => 'required|integer|min:50',
            'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{2})?$/',
            'platform' => 'required|string|in:A,B',
            'status' => 'required|in:Y,N',
            'train_id' => 'required', 
            'departure_station_id' => 'required|different:arrival_station_id',
            'arrival_station_id' => 'required',
        ]);

        $trainroute = new TrainRoute();
        $trainroute_result = $trainroute->checkExistTrainRoute(
            Carbon::createFromFormat('Y-m-d\TH:i', $request->departure_date_time)->format('Y-m-d H:i:s'),
            $request->platform, 
            $request->train_id, 
            $request->departure_station_id, 
            $request->arrival_station_id,
            null
        );

        if(!$trainroute_result->isEmpty()){
            throw ValidationException::withMessages([
                'train_route_exist' => ['This train route exist.']
            ]);
        }

        $response = TrainRoute::create([
            'departure_date_time' => Carbon::createFromFormat('Y-m-d\TH:i', $request->departure_date_time)->format('Y-m-d H:i:s'),
            'total_seats' => $request->total_seats,
            'platform' => $request->platform,
            'price' => $request->price,
            'train_id' => $request->train_id,
            'status' => $request->status,
            'departure_station_id' => $request->departure_station_id,
            'arrival_station_id' => $request->arrival_station_id,
        ]);

        BookingTransaction::create([
            'trx_type' => BookingTrxTypeEnum::IN,
            'trx_in'=> $request->total_seats,
            'trx_out' => 0,
            'status'=> StatusEnum::ACTIVE,
            'booking_id' => 0,
            'train_route_id' => $response->id,
        ]);

        $train_route_result = TrainRoute::with(['departureStation', 'arrivalStation'])->find($response->id);

        return redirect()->route("admin.trainroute.list")->with("success","Successfully added a train route -> from ".$train_route_result->departureStation->name." to ".$train_route_result->arrivalStation->name);
    }

    public function update($id){
        $trainroute = TrainRoute::find($id);

        if(!$trainroute){
            return back()->with("error", "Record Not Found");
        }

        $dateTime = Carbon::parse($trainroute->departure_date_time);

        $formattedDateTime = $dateTime->format('Y-m-d H:i');
        $trainroute->departure_date_time = $formattedDateTime;
        $train = new Train();
        $station = new Station();
        $stations = $station->getStations(null);
        $trains = $train->getAllTrains();

        return view("admin.trainrouteupdate")->with(["trainroute" => $trainroute,'stations'=>$stations, 'trains'=>$trains]);
    }

    public function update_submit(Request $request){
        $request->validate([
            'departure_date_time' => 'required',
            'platform' => 'required|string|in:A,B',
            'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{2})?$/',
            'train_id' => 'required', 
            'status' => 'required|in:Y,N',
            'departure_station_id' => 'required|different:arrival_station_id',
            'arrival_station_id' => 'required',
        ]);

        $trainroute = new TrainRoute();
        $trainroute_result = $trainroute->checkExistTrainRoute(
            Carbon::createFromFormat('Y-m-d\TH:i', $request->departure_date_time)->format('Y-m-d H:i:s'),
            $request->platform, 
            $request->train_id, 
            $request->departure_station_id, 
            $request->arrival_station_id,
            $request->status,
        );

        if(!$trainroute_result->isEmpty()){
            throw ValidationException::withMessages([
                'train_route_exist' => ['This train route exist.']
            ]);
        }

        $trainroute = TrainRoute::find($request->id);
        $trainroute->departure_date_time =  Carbon::createFromFormat('Y-m-d\TH:i', $request->departure_date_time)->format('Y-m-d H:i:s');
        $trainroute->price = $request->price;
        $trainroute->platform = $request->platform;
        $trainroute->train_id = $request->train_id;
        $trainroute->departure_station_id = $request->departure_station_id;
        $trainroute->arrival_station_id = $request->arrival_station_id;
        $trainroute->status = $request->status;
        $trainroute->save(); // Save the changes

        $train_route_result = TrainRoute::with(['departureStation', 'arrivalStation'])->find($request->id);

        return redirect()->route("admin.trainroute.list")->with("success","Successfully updated a train route -> from ".$train_route_result->departureStation->name." to ".$train_route_result->arrivalStation->name);
    }
}

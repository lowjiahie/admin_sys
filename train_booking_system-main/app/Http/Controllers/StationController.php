<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Support\Facades\Validator;

class StationController extends Controller
{
    public function show(Request $request){
        $station = new Station();
        $searchText = $request->input('searchtext');
        $all_stations = null;

        if($searchText){
            $all_stations = $station->searchByName(trim($searchText));
        }else{
            $all_stations = $station->getAllStations();
        }

        return view("admin.stationlist")->with("all_stations",$all_stations);
    }

    public function add(){
        return view("admin.stationadd");
    }

    public function add_submit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('stations')->where(function ($query) use ($request) {
                    return $query->where('name', trim($request->name));
                }),
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'status' => 'required|in:Y,N',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $response = Station::create([
            'name' => trim($request->name),
            'address' => trim($request->address),
            'order' => Station::count()+1,
            'status' => $request->status,
        ]);

        return redirect()->route("admin.station.list")->with("success","Successfully added a station -> name ".$response->name);
    }

    public function update($id){
        $station = Station::find($id);

        if(!$station){
            return back()->with("error", "Record Not Found");
        }

        return view("admin.stationupdate")->with("station", $station);
    }

    public function update_submit(Request $request){
        $station = Station::find($request->id);
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('stations')->where(function ($query) use ($request) {
                    return $query->where('name', trim($request->name));
                }),
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'status' => 'required|in:Y,N',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $station->name = trim($request->name);
        $station->address = trim($request->address);
        $station->status = $request->status;
        $station->save(); // Save the changes

        return redirect()->route("admin.station.list")->with("success","Successfully update a station -> ".$station->name);
    }

    public function update_map(Request $request){
        foreach ($request->items as $item) {
            Station::where('id', $item['id'])->update(['order' => $item['order']]);
        }
        return response()->json(['success' => "Y"], 201);
    }

    public function show_map(){
        $stations = Station::orderBy('order', 'asc')->get();

        return view("admin.stationsort")->with("stations", $stations);
    }

    public function show_train_map(){
        $stations = Station::orderBy('order', 'asc')->get();

        return view("customer.trainmap")->with("stations", $stations);
    }
}

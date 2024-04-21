<?php

namespace App\Http\Controllers;

use App\Models\Train;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TrainController extends Controller
{
    public function show(Request $request){
        $train = new Train();
        $searchText = $request->input('searchtext');
        $all_trains = null;

        if($searchText){
            $all_trains = $train->searchByPlateNo(trim($searchText));
        }else{
            $all_trains = $train->getAllTrains();
        }

        return view("admin.trainlist")->with("all_trains",$all_trains);
    }

    public function add(){
        return view("admin.trainadd");
    }

    public function add_submit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:50',
            ],
            'plate_no' => [
                'required',
                'string',
                'max:20',
                Rule::unique('trains')->where(function ($query) use ($request) {
                    return $query->where('plate_no', trim($request->plate_no));
                }),
            ],
            'status' => 'required|in:Y,N',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $response = Train::create([
            'name' => trim($request->name),
            'plate_no' => trim($request->plate_no),
            'status' => $request->status,
        ]);

        return redirect()->route("admin.train.list")->with("success","Successfully added a train -> plate no ".$response->plate_no);
    }

    public function update($id){
        $train = Train::find($id);

        if(!$train){
            return back()->with("error", "Record Not Found");
        }

        return view("admin.trainupdate")->with("train", $train);
    }

    public function update_submit(Request $request){
        $train = Train::find($request->id);
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:50',
            ],
            'plate_no' => [
                'required',
                'string',
                'max:20',
                Rule::unique('trains')->where(function ($query) use ($request) {
                    return $query->where('plate_no', trim($request->plate_no));
                }),
            ],
            'status' => 'required|in:Y,N',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $train->name = trim($request->name);
        $train->plate_no = trim($request->plate_no);
        $train->status = $request->status;
        $train->save(); // Save the changes

        return redirect()->route("admin.train.list")->with("success","Successfully update a train -> plate no ".$train->plate_no);
    }

}

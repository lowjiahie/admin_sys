<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Enums\StatusEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FeebackController extends Controller
{
    public function feedback(){
        return view("customer.feedbackform");
    }

    public function feedback_submit(Request $request){
        $request->validate([
            'title' => 'required|max:255', // Change 255 to the desired max length for title
            'content' => 'required|max:1000', // Change 1000 to the desired max length for content
        ]);

        $user = session("user");

        Feedback::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => StatusEnum::ACTIVE,
            'user_id' => $user->id,
        ]);

        return back()->with("success", "Feedback has been submitted to us!!");
    }

    public function show(Request $request){
        $feedback = new Feedback();
        $all_feedbacks = $feedback->getAllFeedback();
        

        return view("admin.feedbacklist")->with("all_feedbacks",$all_feedbacks);
    }

   public function update($id){
        $feedback = Feedback::with(['user'])->find($id);

        if(!$feedback){
            return back()->with("error", "Record Not Found");
        }

        return view("admin.feedbackupdate")->with("feedback", $feedback);
    }

    public function update_submit(Request $request){
        $feedback = Feedback::with(['user'])->find($request->id);
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Y,N',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $feedback->status = $request->status;
        $feedback->save(); // Save the changes

        return redirect()->route("admin.feedback.list")->with("success","Successfully update a feedback status");
    }
}

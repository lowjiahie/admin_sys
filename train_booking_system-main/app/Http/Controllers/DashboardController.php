<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\StatusEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use App\Rules\MalaysiaPhoneNumber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    public function show(){
        return view("admin.dashboard");
    }


    public function admin_login(){
        return view("admin.login");
    }

    public function submit_admin_login(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $email = $request->email;
        $password = $request->password;

        $loginUser = $user->get_user_by_email_and_type($email, [UserTypeEnum::NORMAL_ADMIN,UserTypeEnum::SUPER_ADMIN]);

        if ($loginUser) {
            // Make the password field visible temporarily
            $loginUser->makeVisible('password');
            
            // You should be able to access the password field here
            $hashedPassword = $loginUser->password;

            // Hide the password field again
            $user->makeHidden('password');

            // Check if the entered password matches the hashed password
            if (Hash::check($password, $hashedPassword)) {
                $request->session()->put('admin', $loginUser);
                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            }
        }

        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function submit_admin_logout(Request $request){
        // Remove the user data from the session
        $request->session()->forget('admin');

        // Redirect to the login page or any other page after logout
        return redirect()->route('admin.login');
    } 


    public function show_cus(){
        $users = User::where('type',UserTypeEnum::CUSTOMER)->get();

        foreach($users as $user){
            $user->user_type_name = UserTypeEnum::getEnumValue($user->type);
        }

        return view("admin.cuslisting")->with("users",$users);
    }

    
    public function update_cus($id){
        $user = User::find($id);
        $user->user_type_name = UserTypeEnum::getEnumValue($user->type);

        return view("admin.cusupdate")->with("usere",$user);
    }

    public function update_cus_submit(Request $request){
        $request->validate([
            'status' =>'required|in:Y,N',
            'name' => 'required|max:30',
            'phone_num' => ['required', new MalaysiaPhoneNumber],
        ]);

        $user = User::find($request->id);

        $user->name = $request->name;
        $user->phone_num = $request->phone_num;
        $user->status = $request->status;
        $user->update();

        return redirect()->route("admin.cus.list")->with("success","Successfully Update User");
    }

    public function add_cus(){
        return view("admin.cusadd");
    }

    public function add_cus_submit(Request $request){
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'password_confirmation' => 'required',
            'phone_num' => ['required', new MalaysiaPhoneNumber],
        ],
        [
            'password.regex' => 'The password must minimum 8 length and contain at least one lowercase letter, one uppercase letter, one digit, and one special character from @$!%*?&',
        ]);

        $response = User::create([
            'name' => $request->name,
            'phone_num' => $request->phone_num,
            'email'=> $request->email,
            'type' => UserTypeEnum::CUSTOMER,
            'status' => StatusEnum::ACTIVE,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route("admin.cus.list")->with('success', 'Successfully Add User with email ->'.$response->email);

    }

    public function update_password_cus($id){
        $user = User::find($id);
        $user->user_type_name = UserTypeEnum::getEnumValue($user->type);

        return view("admin.cusupdatepass")->with("usere",$user);
    }

    public function update_cus_password_submit(Request $request){
        $request->validate([
            'new_password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'password_confirmation' => 'required',
        ]);

        $user = User::find($request->id);

        if ($request->new_password != $request->password_confirmation) {
            throw ValidationException::withMessages([
                'new_password' => ['The new password does not match with confirm password.']
            ])->redirectTo(route('cus.changepassword'));;
        }

        $user->password = Hash::make($request->new_password);
        $user->update();

        return redirect()->route('admin.cus.list')->with("success","Successfully Update User Password");
    }


    public function show_staff(){
        $users = User::whereIn('type', [UserTypeEnum::NORMAL_ADMIN,UserTypeEnum::SUPER_ADMIN])->get();

        foreach($users as $user){
            $user->user_type_name = UserTypeEnum::getEnumValue($user->type);
        }

        return view("admin.stafflisting")->with("users",$users);
    }

    
    public function update_staff($id){
        $user = User::find($id);
        $user->user_type_name = UserTypeEnum::getEnumValue($user->type);

        return view("admin.staffupdate")->with("usere",$user);
    }

    public function update_staff_submit(Request $request){
        $request->validate([
            'status' =>'required|in:Y,N',
            'type' =>'required|in:20,30',
            'name' => 'required|max:30',
            'phone_num' => ['required', new MalaysiaPhoneNumber],
        ]);

        $user = User::find($request->id);

        $user->name = $request->name;
        $user->phone_num = $request->phone_num;
        $user->type =$request->type;
        $user->status = $request->status;
        $user->update();

        return redirect()->route("admin.staff.list")->with("success","Successfully Update Staff");
    }

    public function update_password_staff($id){
        $user = User::find($id);
        $user->user_type_name = UserTypeEnum::getEnumValue($user->type);

        return view("admin.staffupdatepass")->with("usere",$user);
    }

    public function update_staff_password_submit(Request $request){
        $request->validate([
            'new_password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'password_confirmation' => 'required',
        ]);

        $user = User::find($request->id);

        if ($request->new_password != $request->password_confirmation) {
            throw ValidationException::withMessages([
                'new_password' => ['The new password does not match with confirm password.']
            ])->redirectTo(route('cus.changepassword'));;
        }

        $user->password = Hash::make($request->new_password);
        $user->update();

        return redirect()->route('admin.staff.list')->with("success","Successfully Update Staff Password");
    }

    public function add_staff(){
        return view("admin.staffadd");
    }

    public function add_staff_submit(Request $request){
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'type' =>'required|in:20,30',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'password_confirmation' => 'required',
            'phone_num' => ['required', new MalaysiaPhoneNumber],
        ],
        [
            'password.regex' => 'The password must minimum 8 length and contain at least one lowercase letter, one uppercase letter, one digit, and one special character from @$!%*?&',
        ]);
        $response = User::create([
            'name' => $request->name,
            'phone_num' => $request->phone_num,
            'email'=> $request->email,
            'type' => $request->type,
            'status' => StatusEnum::ACTIVE,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route("admin.staff.list")->with('success', 'Successfully Add Staff with email ->'.$response->email);
    }
}

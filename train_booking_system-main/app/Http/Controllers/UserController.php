<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\StatusEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use App\Mail\UserResetPassword;
use App\Rules\MalaysiaPhoneNumber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function show_all_login_form(){
        return view('customer.login');
    }

    public function submit_all_login(Request $request){
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

        $loginUser = $user->get_user_by_email_and_type($email, []);

        if ($loginUser) {
            // Make the password field visible temporarily
            $loginUser->makeVisible('password');
            
            // You should be able to access the password field here
            $hashedPassword = $loginUser->password;

            // Hide the password field again
            $user->makeHidden('password');

            // Check if the entered password matches the hashed password
            if (Hash::check($password, $hashedPassword)) {
                $request->session()->put('user', $loginUser);
                return redirect()->route('cus.search.schedule')->with('success', 'Login successful!');
            }
        }

        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function submit_all_logout(Request $request){
        // Remove the user data from the session
        $request->session()->forget('user');

        // Redirect to the login page or any other page after logout
        return redirect()->route('cus.search.schedule');
    } 

    public function register(){
        return view("customer.register");
    }

    public function register_submit(Request $request){
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

        return back()->with('success', 'Successfully Register with email ->'.$response->email);
    }


    public function forget_password(){
        return view("customer.forgetpass");
    }


    public function forget_password_submit(Request $request){
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user == null){
            throw ValidationException::withMessages([
                'email' => ['This email does not exist.']
            ]);
        }

        $uniqueId = uniqid();
        $encryptedUserId = Crypt::encryptString($user->id.'-'.$uniqueId);

        // Generate the password reset link with the encrypted user ID
        $resetLink = route('cus.forgetpassword.link', ['id' => $encryptedUserId]);

        Mail::to($user->email)->send(new UserResetPassword($user->name, $resetLink));

        $request->session()->put('userId', $user->id.'-'.$uniqueId);

        return back()->with("success", "Email has been sent to ".$user->email);
    }

    public function forget_password_link($id){
        $decryptedUserId = Crypt::decryptString($id);
        $user = User::find($decryptedUserId);
        $userId = session("userId");
    
        if ($user && $userId != null) {
            $parts = explode('-', $decryptedUserId);
            $session_parts = explode('-', $userId);

            if($parts[1] == $session_parts[1]){
                return view('customer.forgetpasslink')->with('userp', $user);
            }
        }

        return view('customer.forgetpasslink')->with('error',"Link Expire");
    }

    public function forget_password_link_submit(Request $request){
        $request->validate([
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'password_confirmation' => 'required',
        ],
        [
            'password.regex' => 'The password must minimum 8 length and contain at least one lowercase letter, one uppercase letter, one digit, and one special character from @$!%*?&',
        ]);

        $userId = $request->id;
    
        if ($userId != null) {
            $user = User::find($userId);

            if($user){
                $user->password = Hash::make($request->password);
                $user->save();
                $request->session()->forget('userId');

                return view('customer.login')->with("success","Password has been reset -> ".$user->email);
            }
        }

        return back()->with('error',"Invalid Action");
    }

    public function profile_menu(){
        return view("customer.profilemenu");
    }

    public function profile_edit(){
        $user = session("user");

        if($user){
            $user = User::find($user->id);
            $user->user_type_name = UserTypeEnum::getEnumValue($user->type);

            return view("customer.editprofile")->with("usere",$user);
        }

        return redirect()->route('cus.profilemenu')->with('error', 'Invalid Action');
    }

    public function profile_edit_submit(Request $request){
        $request->validate([
            'name' => 'required|max:30',
            'phone_num' => ['required', new MalaysiaPhoneNumber],
        ]);

        $user = User::find($request->id);

        $user->name = $request->name;
        $user->phone_num = $request->phone_num;
        $user->update();

        return redirect()->route('cus.profilemenu')->with("success","Successfully Edit Profile");
    }

    public function profile_changepassword(){
        return view("customer.changepassword");
    }

    public function profile_changepassword_submit(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'password_confirmation' => 'required',
        ]);

        $user = User::find($request->id);

        if (!Hash::check($request->old_password, $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['The old password is incorrect.']
            ])->redirectTo(route('cus.changepassword'));
        }

        if ($request->new_password != $request->password_confirmation) {
            throw ValidationException::withMessages([
                'new_password' => ['The new password does not match with confirm password.']
            ])->redirectTo(route('cus.changepassword'));;
        }

        $user->password = Hash::make($request->new_password);
        $user->update();

        return redirect()->route('cus.profilemenu')->with("success","Successfully Change Password");
    }
}


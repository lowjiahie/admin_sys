<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use Session;

class adminschoolController extends Controller{
    
//    private $repositoryUser;
//
//    public function __construct(repositoryInterface $userRepository) {
//        $this->repositoryUser = $userRepository;
//    }
//
//    public function readUser() {
//        $user = $this->repositoryUser->getAllUser();
//        return view("adminblade.usermanagementpage", compact('user'));
//    }
//
//    public function editUserForm($id) {
//
//        $user = $this->repositoryUser->findUser($id);
//
//        return view("adminblade.edituserform", compact('user'));
//    }
//
//    public function editUserDetail(Request $request) {
//        $request->validate([
//            'name' => 'required',
//            'phone' => 'required',
//            'address' => 'required'
//        ]);
//        $cus = $request->only([
//            'name',
//            'phone',
//            'address'
//        ]);
//
//        $result = $this->repositoryUser->updateUser($request->id, $cus);
//
//        if ($result) {
//            return back()->with('success', 'You have successfully edit customer new information');
//        } else {
//            return back()->with('fail', 'Please try again');
//        }
//    }
//
//    public function deleteuser($id) {
//        $result = $this->repositoryUser->deleteUser($id);
//
//        if ($result) {
//            return back()->with('success', 'You have successfully delete customer');
//        } else {
//            return back()->with('fail', 'Please try again');
//        }
//    }
    
    public function adminmainpage() {
        if (Session::has('login_status')) {
            return view('masterblade/adminschool');
        }
        //return view('adminloginpage');
    }
    public function adminloginpage() {
        return view("adminblade.adminlogin");
    }
    public function adminloginfunction(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $admin = Admin::where('email', '=', $request->email)->first();

        if ($admin) {
            if (hash::check($request->password, $admin->password)) {
                $admin->password = "";
                $request->Session()->put('login_status', $admin);
                return redirect('adminmainpage');
            } else {
                return back()->with('fail', 'Invalid password');
            }
        } else {
            return back()->with('fail', 'This email is not register before');
        }
    }
    
    public function logout() {
        if (Session::has('loginCus')) {
            Log::create([
                'user_id' => Session::get('loginCus')->id,
                'user_type' => 'customer',
                'log_status' => 'logout',
            ])->save();

            Session::pull('loginCus');
            return redirect('login');
        }
    }
    
    public function adminregisterpage() {
        return view("adminblade.adminregisterform");
    }
    
    public function registernewAdmin(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'position' => 'required',
            'yearstarted' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|same:password'
        ]);

        $admin = new Admin();
        $admin->adminID = $request->id;
        $admin->name = $request->name;
        $admin->position = $request->position;
        $admin->yearStarted = $request->yearstarted;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);

        $result = $admin->save();

        if ($result) {
            return back()->with('success', 'Successfully registered an account');
        } else {
            return back()->with('fail', 'Please enter correct information and try again');
        }
    }
    
    public function profilepage() {
        $info = array();
        if (Session::has('login_status')) {
            $info = Admin::where('id', '=', Session::get('login_status')->adminID)->first();
        }
        return view('/adminblade/profilepage', compact('info'));
    }

    public function editprofilepage() {
        $info = array();
        if (Session::has('login_status')) {
            $info = Admin::where('id', '=', Session::get('login_status')->adminID)->first();
        }
        return view('adminblade.updateprofileform', compact('info'));
    }
    
    public function adminprofileupdate(Request $request) {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'yearstarted' => 'required'
        ]);

        if (Session::has('login_status')) {
            $admin = Admin::find(Session::get('login_status')->adminID);
            $admin->name = $request->name;
            $admin->position = $request->position;
            $admin->yearStearted = $request->yearstarted;
            $admin->update();
            return back()->with('success', 'Successfully edited information');
        }
        return back()->with('fail', 'Please try again');
    }

    public function changepasswordform() {
        return view("adminblade.editpasswordpage");
    }
    
    public function updatepassword(Request $request) {
        $request->validate([
            'currentpassword' => 'required',
            'newpassword' => 'required|min:8',
            'confirmpassword' => 'required|same:newpassword'
        ]);

        if (Session::has('login_status')) {
            $admin = Admin::find(Session::get('login_status')->adminID);
            if (hash::check($request->currentpassword, $admin->password)) {
                $admin->password = Hash::make($request->newpassword);
                $admin->update();
                return back()->with('success', 'Successfully edited password');
            }
        }
        return back()->with('fail', 'Please try again');
    }
}

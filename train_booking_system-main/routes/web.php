<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeebackController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TrainRouteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//customer system page
Route::get('/unauthorized', function () {
    return view('customer.unauthorized');
})->name('cus.unauthorized');


Route::get('/', [BookingController::class,'search_schedule'])->name("cus.search.schedule");
Route::get('/map', [StationController::class,'show_train_map'])->name("cus.map");
Route::post('/schedule/submit', [BookingController::class,'submit_schedule'])->name("cus.submit.schedule");
Route::get('/forgetpass/link/{id}',[UserController::class,'forget_password_link'])->name('cus.forgetpassword.link');
Route::post('/forgetpass/link/submit',[UserController::class,'forget_password_link_submit'])->name('cus.forgetpassword.link.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/booking/search', [BookingController::class,'booking_search_schedule'])->name("cus.booking.search.schedule");
    Route::post('/booking/search/submit', [BookingController::class,'submit_schedule'])->name("cus.submit.booking.schedule");
    Route::get('/booking/confirmation', [BookingController::class, "booking_confirm"])->name("cus.booking.confirm");
    Route::post('/create/booking', [BookingController::class,'create_booking'])->name("cus.create.booking");
    Route::get('/booking/success', [BookingController::class, "booking_success"])->name("cus.booking.success");
    Route::get('/booking/view/{status}', [BookingController::class, "booking_filter"])->name("cus.booking.filter");

    Route::get('/profile', [UserController::class, "profile_menu"])->name("cus.profilemenu");
    Route::get('/profile/edit', [UserController::class, "profile_edit"])->name("cus.edit.profile");
    Route::post('/profile/edit/submit', [UserController::class, "profile_edit_submit"])->name("cus.edit.profile.submit");
    Route::get('/profile/changepassword',[UserController::class, "profile_changepassword"])->name("cus.changepassword");
    Route::post('/profile/changepassword/submit',[UserController::class, "profile_changepassword_submit"])->name("cus.changepassword.submit");

    Route::get('/feedback',[FeebackController::class, "feedback"])->name("cus.feedback");
    Route::post('/feedback/submit',[FeebackController::class, "feedback_submit"])->name("cus.feedback.submit");

    Route::get('/logout', [UserController::class,'submit_all_logout'])->name('cus.logout');
});


//After login cannot access to the page
Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/login',[UserController::class, 'show_all_login_form'])->name('cus.login');
    Route::post('/login/submit', [UserController::class, 'submit_all_login'])->name('cus.submit.login');

    Route::get('/register',[UserController::class,'register'])->name('cus.register');
    Route::post('/register/submit',[UserController::class,'register_submit'])->name('cus.register.submit');

    Route::get('/forgetpass',[UserController::class,'forget_password'])->name('cus.forgetpassword');
    Route::post('/forgetpass/submit',[UserController::class,'forget_password_submit'])->name('cus.forgetpassword.submit');
});

Route::prefix('/admin')->middleware('auth.adminredirect')->group(function() {
    Route::get('/login', [DashboardController::class,'admin_login'])->name("admin.login");
    Route::post('/login/submit', [DashboardController::class, 'submit_admin_login'])->name('admin.submit.login');
});


Route::prefix('/admin')->middleware('auth.adminsite:20,30')->group(function() {
    Route::get('/dashboard', [DashboardController::class,'show'])->name("admin.dashboard");

    Route::get('/train/list', [TrainController::class,'show'])->name("admin.train.list");
    Route::get('/train/update/{id}',[TrainController::class,'update'])->name('admin.train.update');
    Route::post('/train/update/submit',[TrainController::class,'update_submit'])->name('admin.train.update.submit');
    Route::get('/train/add',[TrainController::class,'add'])->name('admin.train.add');
    Route::post('/train/add/submit',[TrainController::class,'add_submit'])->name('admin.train.add.submit');

    Route::get('/station/list', [StationController::class,'show'])->name("admin.station.list");
    Route::get('/station/update/{id}',[StationController::class,'update'])->name('admin.station.update');
    Route::post('/station/update/submit',[StationController::class,'update_submit'])->name('admin.station.update.submit');
    Route::get('/station/add',[StationController::class,'add'])->name('admin.station.add');
    Route::post('/station/add/submit',[StationController::class,'add_submit'])->name('admin.station.add.submit');

    Route::get('/trainroute/list', [TrainRouteController::class,'show'])->name("admin.trainroute.list");
    Route::get('/trainroute/update/{id}',[TrainRouteController::class,'update'])->name('admin.trainroute.update');
    Route::post('/trainroute/update/submit',[TrainRouteController::class,'update_submit'])->name('admin.trainroute.update.submit');
    Route::get('/trainroute/add',[TrainRouteController::class,'add'])->name('admin.trainroute.add');
    Route::post('/trainroute/add/submit',[TrainRouteController::class,'add_submit'])->name('admin.trainroute.add.submit');

    Route::get('/feedback/list', [FeebackController::class,'show'])->name("admin.feedback.list");
    Route::get('/feedback/update/{id}',[FeebackController::class,'update'])->name('admin.feedback.update');
    Route::post('/feedback/update/submit',[FeebackController::class,'update_submit'])->name('admin.feedback.update.submit');

    Route::get('/booking/list', [BookingController::class,'show'])->name("admin.booking.list");
    Route::get('/booking/update/{id}', [BookingController::class,'update'])->name("admin.booking.update");
    Route::post('/booking/update/submit',[BookingController::class,'update_submit'])->name('admin.booking.update.submit');

    Route::get('/user/list', [DashboardController::class,'show_cus'])->name("admin.cus.list");
    Route::get('/user/update/{id}',[DashboardController::class,'update_cus'])->name('admin.cus.update');
    Route::post('/user/update/submit',[DashboardController::class,'update_cus_submit'])->name('admin.cus.update.submit');
    Route::get('/user/update/password/{id}',[DashboardController::class,'update_password_cus'])->name('admin.cus.password.update');
    Route::post('/user/update/password/submit',[DashboardController::class,'update_cus_password_submit'])->name('admin.cus.password.update.submit');
    Route::get('/user/add',[DashboardController::class,'add_cus'])->name('admin.cus.add');
    Route::post('/user/add/submit',[DashboardController::class,'add_cus_submit'])->name('admin.cus.add.submit');

    Route::get('/report/monthly_sales_report', [ReportController::class,'show_monthly_report'])->name("admin.monthly.report.list");
    Route::get('/report/transaction_report', [ReportController::class,'show_transaction_report'])->name("admin.transaction.report.list");

    Route::get('/map', [StationController::class,'show_map'])->name("admin.map");
    Route::post('/update/map', [StationController::class,'update_map'])->name("admin.map.update");

    

    Route::get('/logout', [DashboardController::class,'submit_admin_logout'])->name('admin.logout');
});

Route::prefix('/admin')->middleware('auth.adminsite:30')->group(function() {
    Route::get('/staff/list', [DashboardController::class,'show_staff'])->name("admin.staff.list");
    Route::get('/staff/update/{id}',[DashboardController::class,'update_staff'])->name('admin.staff.update');
    Route::post('/staff/update/submit',[DashboardController::class,'update_staff_submit'])->name('admin.staff.update.submit');
    Route::get('/staff/update/password/{id}',[DashboardController::class,'update_password_staff'])->name('admin.staff.password.update');
    Route::post('/staff/update/password/submit',[DashboardController::class,'update_staff_password_submit'])->name('admin.staff.password.update.submit');
    Route::get('/staff/add',[DashboardController::class,'add_staff'])->name('admin.staff.add');
    Route::post('/staff/add/submit',[DashboardController::class,'add_staff_submit'])->name('admin.staff.add.submit');
});

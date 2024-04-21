<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function show_monthly_report(Request $request){
        $searchText = $request->input('searchtext')? $request->input('searchtext'): "2024-01";
        $parsedDate = Carbon::parse($searchText);

        $year = $parsedDate->year;
        $month = $parsedDate->month;

        $booking_obj = new Booking();
        $all_bookings = $booking_obj->getMonthlyReport($month, $year);
        $total_sum_fare = $booking_obj->getMonthlySalesReport($year, $month);


        return view("admin.reportlisting")->with([
            "all_bookings"=> $all_bookings, 
            "total_sum_fare"=>$total_sum_fare,
            "searchtext"=>$searchText,
        ]);
    }

    public function show_transaction_report(Request $request){
        $searchText = $request->input('searchtext')? $request->input('searchtext'): "2024-01";
        $parsedDate = Carbon::parse($searchText);

        $year = $parsedDate->year;
        $month = $parsedDate->month;

        $cash_booking_obj = new Booking();
        $cash_all_bookings = $cash_booking_obj->getTransactionReport($month, $year, "cash");
        $cash_total_sum_fare = $cash_booking_obj->getTransactionSumReport($month, $year, "cash");

        $paypal_booking_obj = new Booking();
        $paypal_all_bookings = $paypal_booking_obj->getTransactionReport($month, $year, "paypal");
        $paypal_total_sum_fare = $paypal_booking_obj->getTransactionSumReport($month, $year, "paypal");


        return view("admin.transactionreport")->with([
            "cash_all_bookings"=> $cash_all_bookings, 
            "cash_total_sum_fare"=>$cash_total_sum_fare,
            "paypal_all_bookings"=>$paypal_all_bookings,
            "paypal_total_sum_fare"=>$paypal_total_sum_fare,
            "searchtext"=>$searchText,
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Enums\BookingStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;


    protected $fillable = [
        'booking_no',
        'name',
        'phone_num',
        'status',
        'payment_type',
        'total_seats',
        'total_fare',
        'user_id',
        'train_route_id',
    ];

    protected $casts = [
        'total_fare' => 'decimal:2',
    ];

    protected $appends = ['sst_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(TrainRoute::class, 'train_route_id');
    }

    public function user_booking($booking_id, $user_id){
        $booking = Booking::with(['user', 'route','route.departureStation', 'route.arrivalStation'])
        ->where('id', $booking_id)
        ->where('user_id', $user_id)
        ->first();

        return $booking;
    }

    public function user_bookings($user_id){
        $bookings = Booking::with(['user', 'route','route.departureStation', 'route.arrivalStation'])
        ->where('user_id', $user_id)
        ->get();

        return $bookings;
    }

    public function user_bookings_based_on_status($user_id, $status){
        $bookingQuery = Booking::with(['user', 'route','route.departureStation', 'route.arrivalStation'])
        ->where('user_id', $user_id);

        if ($status != "all") {
            $bookingQuery->where('status', $status);
        }

        $bookings = $bookingQuery->get();

        return $bookings;
    }

    public function getAllBookings(){
        return Booking::with(['route','route.train', 'route.departureStation', 'route.arrivalStation','user'])->get();
    }

    public function getMonthlyReport($month, $year)
    {
        // Parse the month and year into a Carbon instance
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        // Query to fetch the monthly report
        $monthlyReport = Booking::with(['route','route.train', 'route.departureStation', 'route.arrivalStation','user'])->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        return $monthlyReport;
    }

    public function getMonthlySalesReport($year, $month)
    {
        // Validate and parse the year and month
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        // Query to calculate total sales within the specified month
        $monthlySales = Booking::with(['route','route.train', 'route.departureStation', 'route.arrivalStation','user'])->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_fare');

        return $monthlySales;
    }

    public function getTransactionReport($month, $year, $paymentType)
    {
        // Parse the month and year into a Carbon instance
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        // Query to fetch the monthly report
        $monthlyReport = Booking::with(['route','route.train', 'route.departureStation', 'route.arrivalStation','user'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where("payment_type", $paymentType)
            ->get();

        return $monthlyReport;
    }

    public function getTransactionSumReport($month, $year, $paymentType)
    {
        // Parse the month and year into a Carbon instance
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        // Query to fetch the monthly report
        $monthlyReport = Booking::with(['route','route.train', 'route.departureStation', 'route.arrivalStation','user'])->whereBetween('created_at', [$startDate, $endDate])
            ->where("payment_type", $paymentType)
            ->sum('total_fare');

        return $monthlyReport;
    }



    public function getSstPriceAttribute(){
        return round($this->total_fare - ($this->total_fare/1.06),2);
    }

}

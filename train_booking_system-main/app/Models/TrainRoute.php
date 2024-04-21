<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainRoute extends Model
{
    use HasFactory;


    protected $fillable = [
        'departure_date_time',
        'total_seats',
        'platform',
        'price',
        'train_id',
        'departure_station_id',
        'arrival_station_id',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2', // Cast 'price' column to decimal with 2 decimal places
    ];
    

    protected $appends = ['available_seats'];

    public function train()
    {
        return $this->belongsTo(Train::class);
    }

    public function departureStation()
    {
        return $this->belongsTo(Station::class, 'departure_station_id');
    }

    public function arrivalStation()
    {
        return $this->belongsTo(Station::class, 'arrival_station_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function transactions()
    {
        return $this->hasMany(BookingTransaction::class);
    }

    public function getAllTrainRoute(){
        $trainRoutes = TrainRoute::with(['train', 'departureStation', 'arrivalStation'])->get();

        return $trainRoutes;
    }

    public function getTrainRoute($origin, $destination, $departure_datetime_start, $departure_datetime_end){
        $trainRoutes = TrainRoute::with(['train', 'departureStation', 'arrivalStation'])
        ->where('departure_station_id', $origin)
        ->where('arrival_station_id', $destination)
        ->where('departure_date_time','>=', $departure_datetime_start)
        ->where('departure_date_time','<=', $departure_datetime_end)
        ->get();

        return $trainRoutes;
    }

    public function getTrainRouteWithId($id){
        $trainRoutes = TrainRoute::with(['train', 'departureStation', 'arrivalStation'])
        ->where('id', $id)
        ->get();

        return $trainRoutes;
    }

    public function getTrainRouteMatchWithOrderQty($trainRoutes, $order_pax){
        $filteredTrainRoutes = $trainRoutes->filter(function ($trainRoute) use ($order_pax) {
            return $trainRoute->available_seats >= $order_pax;
        });
    
        return $filteredTrainRoutes;
    }

    public function checkExistTrainRoute($formattedDatetime,$platform, $train_id, $departure_station_id, $arrival_station_id, $status){
        $actualQuery = TrainRoute::where('departure_date_time', $formattedDatetime)
        ->where('platform', $platform)
        ->where('train_id', $train_id)
        ->where('departure_station_id', $departure_station_id)
        ->where('arrival_station_id', $arrival_station_id);

        if($status){
            $actualQuery->where('status', $status);
        }
        
        return $actualQuery->get();
    }

    // Define accessor for the available_seats attribute
    public function getAvailableSeatsAttribute()
    {
        $booking_trx = new BookingTransaction();
        $availableSeats = $booking_trx->availableTotalSeats($this->id);
            
        // Set a default value if available seats calculation results in a negative value
        return $availableSeats;
    }
}

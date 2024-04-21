<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Enums\BookingTrxTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_type',
        'trx_in',
        'trx_out',
        'status',
        'booking_id',
        'train_route_id',
    ];

    protected $casts = [
        'trx_type' => BookingTrxTypeEnum::class,
        'status' => StatusEnum::class,
    ];

    public function route()
    {
        return $this->belongsTo(TrainRoute::class);
    }


    public function availableTotalSeats($troute_id){
        $total_in = BookingTransaction::where('trx_type',BookingTrxTypeEnum::IN)->where('train_route_id',$troute_id)->sum('trx_in');
        $total_out = BookingTransaction::where('trx_type',BookingTrxTypeEnum::OUT)->where('train_route_id',$troute_id)->sum('trx_out');
    
        // Coalesce to ensure default value of 0 if null
        $total_in = $total_in ? $total_in : 0;
        $total_out = $total_out ? $total_out : 0;
        
        return ($total_in - $total_out);
    }
}

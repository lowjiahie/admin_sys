<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'address',
        'status',
    ];

    protected $attributes = [
        'status' => StatusEnum::ACTIVE,
    ];

    public function departureRoutes()
    {
        return $this->hasMany(TrainRoute::class, 'departure_station_id');
    }

    public function arrivalRoutes()
    {
        return $this->hasMany(TrainRoute::class, 'arrival_station_id');
    }

    public function getStations($excludedStations)
    {
        if ($excludedStations !== null && !empty($excludedStations)) {
            return $this->whereNotIn('id', $excludedStations)->get();
        } else {
            return $this->where('status', StatusEnum::ACTIVE)->get();
        }
    }

    public function getAllStations()
    {
        return $this->all();
    }

    public function searchByName($name){
        return $this->where("name", $name)->get();
    }
}

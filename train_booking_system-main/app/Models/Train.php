<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Train extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'plate_no',
        'status',
    ];

    protected $attributes = [
        'status' => StatusEnum::ACTIVE,
    ];
    
    public function routes()
    {
        return $this->hasMany(TrainRoute::class);
    }


    public function getAllTrains()
    {
        return $this->all();
    }

    public function searchByPlateNo($plate_no){
        return $this->where("plate_no", $plate_no)->get();
    }
}

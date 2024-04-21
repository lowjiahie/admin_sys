<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback'; // Specify the table name if it's different from the model name convention

    protected $fillable = [
        'title',
        'content',
        'status',
        'user_id',
    ];

    // Define the default value for the 'status' attribute
    protected $attributes = [
        'status' => StatusEnum::ACTIVE,
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAllFeedback(){
        return $this->with(['user'])->get();
    }
}

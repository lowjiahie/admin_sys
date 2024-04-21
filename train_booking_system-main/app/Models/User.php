<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone_num',
        'type',
        'status',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'type' => UserTypeEnum::class,
        'status' => StatusEnum::class
    ];

    protected $appends = ['user_type_name'];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    

    public function get_user_by_email_and_type($email, $types){
        $userQuery = User::where('email', $email)->where("status",StatusEnum::ACTIVE);

        if (!empty($types)) {
            $userQuery->whereIn('type', $types);
        }

        $user = $userQuery->first();

        return $user;
    }
}

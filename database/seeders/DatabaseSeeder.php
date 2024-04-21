<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Train;
use App\Models\Booking;
use App\Models\Station;
use App\Enums\StatusEnum;
use App\Models\TrainRoute;
use App\Enums\UserTypeEnum;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Enums\BookingTrxTypeEnum;
use App\Models\BookingTransaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    }

}

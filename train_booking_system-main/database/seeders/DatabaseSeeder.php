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
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Station::truncate();
        Train::truncate();
        TrainRoute::truncate();
        Booking::truncate();
        BookingTransaction::truncate();

        Schema::enableForeignKeyConstraints();
        $this->seedUser();
        $this->seedStation();
        $this->seedTrain();
        $this->seedTrainRoute();
    }



    private function seedUser(){
        // Create a user with CUSTOMER type and ACTIVE status
        User::create([
            'name' => 'John Doe',
            'phone_num' => '123456789',
            'type' => UserTypeEnum::CUSTOMER,
            'status' => StatusEnum::ACTIVE,
            'email' => '123@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Create a user with NORMAL_ADMIN type and ACTIVE status
        User::create([
            'name' => 'Jane Doe',
            'phone_num' => '987654321',
            'type' => UserTypeEnum::NORMAL_ADMIN,
            'status' => StatusEnum::ACTIVE,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Create a user with SUPER_ADMIN type and INACTIVE status
        User::create([
            'name' => 'Admin User',
            'phone_num' => '555555555',
            'type' => UserTypeEnum::SUPER_ADMIN,
            'status' => StatusEnum::ACTIVE,
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }

    private function seedStation(){
        $stations = [
            ['name' => 'KL Sentral', 'address' => 'Kuala Lumpur Sentral, 50470 Kuala Lumpur, Malaysia'],
            ['name' => 'Kajang', 'address' => 'Jalan Reko, 43000 Kajang, Selangor, Malaysia'],
            ['name' => 'Seremban', 'address' => 'Jalan Sungai Ujong, 70200 Seremban, Negeri Sembilan, Malaysia'],
            ['name' => 'Kuala Kubu Bharu', 'address' => '44000 Kuala Kubu Bharu, Selangor, Malaysia'],
            ['name' => 'Tanjung Malim', 'address' => '35900 Tanjong Malim, Perak, Malaysia'],
            ['name' => 'Rawang', 'address' => 'Selangor, Malaysia'],
            ['name' => 'Kuala Lumpur', 'address' => 'Jalan Haji Sirat, 31650 Ipoh, Perak, Malaysia'],
            ['name' => 'Batang Kali', 'address' => 'Jalan Stesen, 44300 Batang Kali, Selangor, Malaysia'],
            ['name' => 'Sungai Buloh', 'address' => '47000 Sungai Buloh, Selangor, Malaysia'],
            ['name' => 'Klang', 'address' => 'Kawasan 1, 41000 Klang, Selangor, Malaysia'],
            ['name' => 'Kapar', 'address' => 'Jalan Stesen, 42200 Kapar, Selangor, Malaysia'],
            ['name' => 'Subang Jaya', 'address' => '47500 Subang Jaya, Selangor, Malaysia'],
            ['name' => 'Batu Tiga', 'address' => 'Shah Alam, Selangor, Malaysia'],
            ['name' => 'Shah Alam', 'address' => 'Shah Alam, Selangor, Malaysia'],
            ['name' => 'Kuala Lumpur International Airport', 'address' => 'Jalan Pekeliling, 64000 Sepang, Selangor, Malaysia'],
            ['name' => 'Nilai', 'address' => 'Pusat Bandar Nilai, 71800 Nilai, Negeri Sembilan, Malaysia'],
            ['name' => 'Senawang', 'address' => 'Senawang, 70450 Seremban, Negeri Sembilan, Malaysia'],
            ['name' => 'Rembau', 'address' => '73000 Rembau, Negeri Sembilan, Malaysia'],
            ['name' => 'Pulau Sebang / Tampin', 'address' => 'Tampin, Negeri Sembilan, Malaysia'],
            ['name' => 'Gemas', 'address' => 'Gemas, 73400 Gemas, Negeri Sembilan, Malaysia'],
        ];
        $order = 1;
        foreach ($stations as $stationData) {
            $stationData['status'] = StatusEnum::ACTIVE;
            $stationData['order'] = $order;
            Station::create($stationData);
            $order++;
        }
    }

    private function seedTrain(){
        $trains = [
            ['name' => 'Train 1', 'plate_no' => 'PLT001'],
            ['name' => 'Train 2', 'plate_no' => 'PLT002'],
            ['name' => 'Train 3', 'plate_no' => 'PLT003'],
            ['name' => 'Train 4', 'plate_no' => 'PLT004'],
            ['name' => 'Train 5', 'plate_no' => 'PLT005'],
            ['name' => 'Train 6', 'plate_no' => 'PLT006'],
            ['name' => 'Train 7', 'plate_no' => 'PLT007'],
            ['name' => 'Train 8', 'plate_no' => 'PLT008'],
            ['name' => 'Train 9', 'plate_no' => 'PLT009'],
            ['name' => 'Train 10', 'plate_no' => 'PLT010'],
            ['name' => 'Train 11', 'plate_no' => 'PLT011'],
            ['name' => 'Train 12', 'plate_no' => 'PLT012'],
            ['name' => 'Train 13', 'plate_no' => 'PLT013'],
            ['name' => 'Train 14', 'plate_no' => 'PLT014'],
            ['name' => 'Train 15', 'plate_no' => 'PLT015'],
            ['name' => 'Train 16', 'plate_no' => 'PLT016'],
            ['name' => 'Train 17', 'plate_no' => 'PLT017'],
            ['name' => 'Train 18', 'plate_no' => 'PLT018'],
            ['name' => 'Train 19', 'plate_no' => 'PLT019'],
            ['name' => 'Train 20', 'plate_no' => 'PLT020'],
        ];

        // Insert the trains into the trains table using the insert method
        foreach ($trains as $train) {
            $train['status'] = StatusEnum::ACTIVE;
            Train::create($train);
        }

    }

    private function seedTrainRoute(){

        $randomHour = mt_rand(0, 23);  // Random hour between 0 and 23
        $randomMinute = mt_rand(0, 59);  // Random minute between 0 and 59
        $randomSecond = mt_rand(0, 59);  // Random second between 0 and 59
        // Sample data for train routes
        $routes = [
            [
                'departure_date_time' => Carbon::now()->addDays(1)->format('Y-m-d H:i:s'), // Departure time tomorrow
                'total_seats' => 100,
                'platform' => 'A',
                'price' => 50.00,
                'train_id' => 1, // Assuming train ID 1 exists
                'departure_station_id' => 1, //KL Sentral Assuming departure station ID 1 exists
                'arrival_station_id' => 3, //Seremban Assuming arrival station ID 2 exists
            ],
            [
                'departure_date_time' => Carbon::now()->addDays(2)->format('Y-m-d H:i:s'), // Departure time in 2 days
                'total_seats' => 120,
                'platform' => 'B',
                'price' => 60.00,
                'train_id' => 2, // Assuming train ID 2 exists
                'departure_station_id' => 2, //Kajang Assuming departure station ID 2 exists
                'arrival_station_id' => 4, //Kuala Kubu Bharu Assuming arrival station ID 3 exists
            ],
            [
                'departure_date_time' => Carbon::now()->addDays(2)->format('Y-m-d H:i:s'), // Departure time in 2 days
                'total_seats' => 130,
                'platform' => 'A',
                'price' => 40.00,
                'train_id' => 3, // Assuming train ID 2 exists
                'departure_station_id' => 2, //Kajang Assuming departure station ID 2 exists
                'arrival_station_id' => 6, //Rawang Assuming arrival station ID 3 exists
            ],
            [
                'departure_date_time' => Carbon::now()->addDays(2)->setTime($randomHour, $randomMinute, $randomSecond)->format('Y-m-d H:i:s'), // Departure time in 2 days
                'total_seats' => 130,
                'platform' => 'A',
                'price' => 6.00,
                'train_id' => 4, // Assuming train ID 2 exists
                'departure_station_id' => 2, //Kajang Assuming departure station ID 2 exists
                'arrival_station_id' => 6, //Rawang Assuming arrival station ID 3 exists
            ],
            // Add more routes as needed
        ];

        foreach ($routes as $route) {
            $train_route = TrainRoute::create($route);

            BookingTransaction::create([
                'trx_type' => BookingTrxTypeEnum::IN,
                'trx_in' => $train_route->total_seats,
                'trx_out' => 0,
                'status' => StatusEnum::ACTIVE,
                'booking_id' => 0,
                'train_route_id' => $train_route->id,
            ]);
        }
    }
}

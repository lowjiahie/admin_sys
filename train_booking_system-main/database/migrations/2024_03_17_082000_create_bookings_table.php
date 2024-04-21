<?php

use App\Enums\BookingStatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string("booking_no")->unique();
            $table->string("name");
            $table->string("phone_num");
            $table->string("status")->default(BookingStatusEnum::PENDING);
            $table->string("payment_type")->default("C");
            $table->integer("total_seats");
            $table->decimal('total_fare',10,2);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('train_route_id');
            $table->timestamps();

            
            $table->foreign('user_id')->references('id')->on('trains')->onDelete('cascade');
            $table->foreign('train_route_id')->references('id')->on('train_routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

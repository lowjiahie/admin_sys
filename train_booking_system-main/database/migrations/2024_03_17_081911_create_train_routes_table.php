<?php

use App\Enums\StatusEnum;
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
        Schema::create('train_routes', function (Blueprint $table) {
            $table->id();
            $table->dateTime("departure_date_time");
            $table->integer("total_seats");
            $table->string("platform");
            $table->decimal("price",8, 2);
            $table->string('status',1)->default(StatusEnum::ACTIVE);
            $table->unsignedBigInteger('train_id');
            $table->unsignedBigInteger('departure_station_id');
            $table->unsignedBigInteger('arrival_station_id');
            $table->timestamps();

            $table->foreign('train_id')->references('id')->on('trains')->onDelete('cascade');
            $table->foreign('departure_station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->foreign('arrival_station_id')->references('id')->on('stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('train_routes');
    }
};

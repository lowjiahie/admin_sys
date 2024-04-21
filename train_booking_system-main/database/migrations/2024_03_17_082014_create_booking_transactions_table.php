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
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->string("trx_type");
            $table->integer("trx_in");
            $table->integer("trx_out");
            $table->string('status',1)->default(StatusEnum::ACTIVE);
            $table->unsignedBigInteger('booking_id')->dafault(0);
            $table->unsignedBigInteger('train_route_id');
            $table->timestamps();

            $table->foreign('train_route_id')->references('id')->on('train_routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};

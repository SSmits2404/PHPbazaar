<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advert_id');
            $table->unsignedBigInteger('renter_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->foreign('advert_id')->references('id')->on('adverts');
            $table->foreign('renter_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

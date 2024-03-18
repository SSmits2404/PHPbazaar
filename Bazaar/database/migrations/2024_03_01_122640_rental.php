<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Rental', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('User');
            $table->unsignedBigInteger('advert');
            $table->date('startDate');
            $table->date('EndDate');
            
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('advert')->references('id')->on('adverts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Rental');
    }
};

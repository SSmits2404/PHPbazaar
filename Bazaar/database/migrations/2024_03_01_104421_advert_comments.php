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
        Schema::create('AdvertComments', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('reviewer');
            $table->unsignedBigInteger('advert');
            $table->float('review');
            $table->timestamps();
            
            $table->foreign('reviewer')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('advert')->references('id')->on('adverts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AdvertComments');
    }
};


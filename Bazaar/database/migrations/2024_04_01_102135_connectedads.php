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
        Schema::create('connectedads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject'); // Add the 'subject' column
            $table->unsignedBigInteger('connected'); // Add the 'connected' column
            $table->foreign('subject')->references('id')->on('adverts');
            $table->foreign('connected')->references('id')->on('adverts');
            $table->timestamps();
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

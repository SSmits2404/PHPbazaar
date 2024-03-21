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
        Schema::create('UserComments', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('reviewer');
            $table->unsignedBigInteger('reviewee');
            $table->float('review');
            
            $table->foreign('reviewer')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewee')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UserComments');
    }
};

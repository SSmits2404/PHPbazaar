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
        Schema::create('adverts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('user_id'); // Foreign key referencing 'id' on the 'users' table
            $table->decimal('price', 8, 2); // Price with 8 digits in total and 2 after the decimal
            $table->string('title'); // Column for the advert title
            $table->text('advertisement_text'); // Column for the advertisement text
            $table->timestamps(); // Adds created_at and updated_at columns
        
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};

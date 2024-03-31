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
            $table->decimal('price', 8, 2)->nullable(); // Price with 8 digits in total and 2 after the decimal
            $table->string('title'); // Column for the advert title
            $table->text('advertisement_text'); // Column for the advertisement text
            $table->timestamps(); // Adds created_at and updated_at columns
            $table->dateTime('expires_at')->nullable(); // Nullable column for the expiration date of the advert
            $table->float('bid', 10, 2)->nullable(); // Nullable column for the latitude of the advert
            $table->unsignedBigInteger('bidder_id')->nullable(); // Nullable column for the bidder's ID
            $table->string('afbeelding')->nullable();
            $table->unsignedBigInteger('company_id')->nullable(); // Nullable column for the company's ID
            $table->enum('advert_type', ['sale', 'auction', 'rental'])->default('sale'); // Enum column for the advert type
            $table->boolean('sold')->default(false); // Boolean column for the sold status of the advert
            $table->boolean('isrental')->default(false); // Boolean column for the rental status of the advert
            $table->integer('base_durability')->nullable(); // Nullable column for the base durability of the advert
            $table->integer('durability')->nullable(); // Nullable column for the durability of the advert
            $table->integer('wear')->nullable(); // Nullable column for the wear of the advert
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bidder_id')->references('id')->on('users')->onDelete(('set null')); 
            
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

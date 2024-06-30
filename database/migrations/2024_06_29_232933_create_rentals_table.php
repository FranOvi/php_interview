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

            $table->decimal('latitude', 8, 6);
            $table->decimal('longitude', 9, 6);
            $table->string('title');
            $table->string('advertiser');
            $table->string('description', 2500);
            $table->boolean('reformed')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('type', 20);
            $table->decimal('price', 10, 2);
            $table->decimal('price_per_sqm', 10, 2);
            $table->string('address', 1000);
            $table->string('province');
            $table->string('city');
            $table->decimal('square_meter', 10, 2);
            $table->integer('rooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->boolean('parking')->nullable();
            $table->boolean('second_hand')->nullable();
            $table->boolean('built_in_closet')->nullable();
            $table->integer('built_in_year')->nullable();
            $table->boolean('furnished')->nullable();
            $table->string('individual_heating')->nullable();
            $table->boolean('energy_certification')->nullable();
            $table->integer('floors')->nullable();
            $table->boolean('exterior')->nullable();
            $table->boolean('interior')->nullable();
            $table->boolean('elevator')->nullable();
            $table->date('date')->nullable();
            $table->string('street')->nullable();
            $table->string('neighbourhood')->nullable();
            $table->string('district')->nullable();
            $table->boolean('terrace')->nullable();
            $table->boolean('storage_room')->nullable();
            $table->boolean('equipped_kitchen')->nullable();
            $table->boolean('air_conditioner')->nullable();
            $table->boolean('pool')->nullable();
            $table->boolean('garden')->nullable();
            $table->decimal('usable_square_meter', 10, 2)->nullable();
            $table->boolean('reduced_mobility_suitable')->nullable();
            $table->boolean('pets_allowed')->nullable();
            $table->boolean('balcony')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};

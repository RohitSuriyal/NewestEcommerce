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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("customer_id");
            $table->string("mobile_no");
            $table->string('pincode');
            $table->string("locality");
            $table->string("address");
            $table->string("city");
            $table->string("state");
            $table->string("landmark");
            $table->string("alternate_number");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};

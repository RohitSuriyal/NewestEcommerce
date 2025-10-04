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
        Schema::table("users", function (Blueprint $table) {


            $table->string("otp")->nullable();
            $table->string("password")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {


        Schema::table("users", function (Blueprint $table) {

           $table->dropColumn("otp");

            // Revert password back to NOT NULL
            $table->string("password")->nullable(false)->change();
        });
    }
};

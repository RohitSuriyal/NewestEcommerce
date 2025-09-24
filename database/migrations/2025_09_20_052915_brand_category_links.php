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
        Schema::create('brand_category_links', function (Blueprint $table) {
            $table->id();
           

            $table->foreignId('brand_id')
                ->constrained('brands')   // explicitly point to "brands" table
                ->onDelete('cascade');

            $table->foreignId('category_id')
                ->constrained('product_categories') // explicitly point to "categories" table
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};

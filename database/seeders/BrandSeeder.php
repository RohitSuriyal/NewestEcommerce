<?php

namespace Database\Seeders;

use App\Models\Admin\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0;$i<10;$i++) {
            Brand::create([
                "name"=>Str::random(10)
            ]);
        }
    }
}

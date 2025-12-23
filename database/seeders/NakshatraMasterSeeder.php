<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NakshatraMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nakshatras = [
            'Ashwini',
            'Bharani',
            'Krittika',
            'Rohini',
            'Mrigashira',
            'Ardra',
            'Punarvasu',
            'Pushya',
            'Ashlesha',
            'Magha',
            'Purva Phalguni',
            'Uttara Phalguni',
            'Hasta',
            'Chitra',
            'Swati',
            'Vishakha',
            'Anuradha',
            'Jyeshta',
            'Mula',
            'Purva Ashadha',
            'Uttara Ashadha',
            'Shravana',
            'Dhanishta',
            'Shatabhisha',
            'Purva Bhadrapada',
            'Uttara Bhadrapada',
            'Revati',
        ];

        foreach ($nakshatras as $nakshatra) {
            DB::table('nakshatra_master')->insert([
                'name' => $nakshatra,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

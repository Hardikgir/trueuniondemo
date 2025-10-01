<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CasteMaster;

class CasteMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $castes = [
            ['title' => 'Brahmin'],
            ['title' => 'Kshatriya'],
            ['title' => 'Vaishya'],
            ['title' => 'Shudra'],
            ['title' => 'Other'],
        ];

        foreach ($castes as $caste) {
            CasteMaster::create($caste);
        }
    }
}
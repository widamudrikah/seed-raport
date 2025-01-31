<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicYears = [
            ['year' => '2023/2024', 'semester' => 'Ganjil'],
            ['year' => '2023/2024', 'semester' => 'Genap'],
            ['year' => '2024/2025', 'semester' => 'Ganjil'],
            ['year' => '2024/2025', 'semester' => 'Genap'],
        ];

        DB::table('tahun_ajars')->insert($academicYears);
    }
}

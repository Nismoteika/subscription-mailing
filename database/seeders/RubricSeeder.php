<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RubricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rubrics')->insert([
            'title' => 'movies',
        ]);

        DB::table('rubrics')->insert([
            'title' => 'politics',
        ]);

        DB::table('rubrics')->insert([
            'title' => 'weather',
        ]);
    }
}

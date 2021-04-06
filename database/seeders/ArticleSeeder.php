<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'title' => 'new movie #1',
            'text' => 'see the new movie',
            'rubric_id' => 1,
        ]);

        DB::table('articles')->insert([
            'title' => 'new politic #1',
            'text' => 'see the new politics',
            'rubric_id' => 2,
        ]);

        DB::table('articles')->insert([
            'title' => 'new weather #1',
            'text' => 'see the new weather',
            'rubric_id' => 3,
        ]);
    }
}

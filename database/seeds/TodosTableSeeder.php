<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->truncate();
        DB::table('todos')->insert([
            [
                'title'      => 'Laravel Lessonを終わらせる',
                'created_at' => Carbon::create(2019, 5, 17),
                'updated_at' => Carbon::create(2019, 5, 17),
            ],
            [
                'title'      => 'レビューに向けて理解を深める',
                'created_at' => Carbon::create(2019, 5, 17),
                'updated_at' => Carbon::create(2019, 5, 17),
            ],
        ]);
    }
}

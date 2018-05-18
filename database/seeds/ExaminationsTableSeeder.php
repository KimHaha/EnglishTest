<?php

use Illuminate\Database\Seeder;

class ExaminationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $examinations = [
        	['']
        ];
        DB::table('examinations')->insert($examinations);
    }
}

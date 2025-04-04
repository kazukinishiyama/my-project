<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ThreadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('threads')->insert([
            'user_id' => 0,
            'name' => 'test1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

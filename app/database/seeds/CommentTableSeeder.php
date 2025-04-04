<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('comments')->insert([
            'user_id' => 0,
            'thread_id' => '2',
            'content' => 'helloworld',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

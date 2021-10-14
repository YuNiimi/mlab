<?php

use Illuminate\Database\Seeder;
use App\Assignment;

class AssignmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assignment::insert(['user_id'=>4,'assignment'=>'11,12,21,22,51']);
    }
}

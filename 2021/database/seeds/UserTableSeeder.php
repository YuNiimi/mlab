<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ['test2','test3 ','test4'];
        foreach ($users as $user) {
            User::updateOrCreate(
                ['name' => $user]
            );
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Reservation;

class ReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;
        $date = Carbon::today();

        for($i=1;$i<4;$i++){
            Reservation::insert(
                ['user_id'=> $i,'date'=>$date,'AM' => $i%2,'PM'=>0,'Bulk'=>0]
            );
        }
    }
}

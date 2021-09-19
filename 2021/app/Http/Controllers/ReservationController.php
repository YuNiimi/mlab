<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;
class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function index_all(){
        $today=Carbon::today();
        $reservations = Reservation::where('date','>',$today)->get();
        return view('today')->with('reservations',$reservations);
    }

    public function index_user(){
    }
}

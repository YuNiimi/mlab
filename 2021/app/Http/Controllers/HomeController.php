<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //今日の予約状況とデフォルト登録日かどうかを確認
        $today = Carbon::today();
        //リレーション（ユーザテーブル）、今日 AND 自分以外 AND ( AMまたはPMが1) 
        $id = Auth::id();
        $reservations = Reservation::where('user_id','!=',$id)->with('user')->where('date',$today)
        ->where(function($query){
            $query->where('AM',1)->orWhere('PM',1);
        })->get();
        $my_reservation = Reservation::with('user')->where('user_id',$id)->where('date',$today)->first();
        return view('home')->with(['reservations'=>$reservations,'my_reservation'=>$my_reservation]);
    }
}

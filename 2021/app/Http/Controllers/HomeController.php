<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Assignment;
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
        $date = $today;
        //リレーション（ユーザテーブル）、今日 AND 自分以外 AND ( AMまたはPMが1) 
        $id = Auth::id();
        $reservations = Reservation::where('user_id','!=',$id)->with('user')->where('date',$date)
        ->where(function($query){
            $query->where('AM',1)->orWhere('PM',1);
        })->get();
        $my_reservation = Reservation::with('user')->where('user_id',$id)->where('date',$date)->first();
        $state = 1;
        return view('home')->with(['reservations'=>$reservations,'my_reservation'=>$my_reservation,'date'=>$date,'state' => $state]);
    }

    public function date($date){
        $date = new Carbon($date);
        $id = Auth::id();

        $reservations = Reservation::where('user_id','!=',$id)->with('user')->where('date',$date)
        ->where(function($query){
            $query->where('AM',1)->orWhere('PM',1);
        })->get();
        $my_reservation = Reservation::with('user')->where('user_id',$id)->where('date',$date)->first();
        //stateチェック（登録可能かどうか：固定枠と日付から）
        $state = "";

        $assignments = Assignment::where("user_id",$id)->first()->toArray();
        $assignments = $assignments["assignments"];
        dd($assignments);


        if(Carbon::today() > $date){

            // foreach($assignments as $assignment){
            //     $assignment = str_split($assignment);
            // }
        }
        return view('home')->with(['date'=>$date,'reservations'=>$reservations,'my_reservation'=>$my_reservation,'date'=>$date,'state'=>$state]);
    }

    public function reserve(Request $request){
        $AM = $request->input('AM');
        $PM = $request->input('PM');
        $user = Auth::id();
        
        //日付受け取り＋その日付に遷移すること
        $today = Carbon::today();
        if($AM=='on')$AM=1;else $AM=0;
        if($PM=='on')$PM=1;else $PM=0;
        Reservation::updateOrCreate(
            ['user_id'=>$user,'date'=>$today],
            ['AM'=>$AM,'PM'=>$PM]
        );
        
        return redirect('/home')->with('flash_message', '登録完了');

    }
}

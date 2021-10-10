<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //自分の列がどこか
        //なかったら一番下に追加
        $reservations = [['user_name','gozen','gogo'],['aaa',1,1]];
        return view('home')->with('reservations',$reservations);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

use App\Position;
use App\SparePartOrder;
use App\Info;

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
        $agent = new Agent();

        if (Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect('login');
        }

        $positions = Position::all();
        $sparepartorders = SparePartOrder::where('user_id', $user->id)->where('done', 0)->with('sparepart')->with('position')->orderBy('date')->get();
        $info = Info::first();
        $today = now();

        if ($agent -> isMobile()){
            return view('welcomemobile', compact('positions', 'sparepartorders', 'info', 'today'));
        }
        else{
            return view('welcome', compact('positions', 'sparepartorders', 'info', 'today'));
        }

    }
}

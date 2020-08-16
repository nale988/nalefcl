<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

use App\Position;
use App\SparePartOrder;
use App\Info;
use App\WorkOrder;

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

        $user = Auth::check() ? Auth::user() : redirect() -> back() -> with('message', 'Ulogujte se.');

        $sparepartorders = SparePartOrder::where('user_id', $user->id)->where('done', 0)->with('sparepart')->with('position')->orderBy('date')->get();
        $workorders = WorkOrder::orderByDesc('date')->get()->take(10);
        $username_raw = explode(" ", $user -> name);
        $username = $username_raw[1]." ".substr($username_raw[0], 0, 1);
        $myworkorders = WorkOrder::where('owner', $username)->orderByDesc('date')->get()->take(10);

        $info = Info::first();
        $base = Info::find(2);
        $today = now();

        // print_r(json_encode($myworkorders));
        // die;

        if ($agent -> isMobile()){
             return view('welcomemobile', compact('workorders', 'myworkorders', 'sparepartorders', 'info', 'today', 'base'));
        }
        else{
            return view('welcome', compact('workorders', 'myworkorders', 'sparepartorders', 'info', 'today', 'base'));
        }

    }
}

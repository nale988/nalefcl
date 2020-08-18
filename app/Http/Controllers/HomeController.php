<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

use App\Position;
use App\SparePartOrder;
use App\Info;
use App\WorkOrder;
use DB;

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

        if(Auth::check()) {
            $user = Auth::user();
        }
        else {
            return redirect('/login')->with('alert', 'Niste ulogovani');
        }

        $workorders = WorkOrder::all()->sortByDesc('date')->take(10);
        $username_raw = explode(" ", $user -> name);
        $username = $username_raw[1]." ".substr($username_raw[0], 0, 1);
        $myworkorders = WorkOrder::where('owner', $username)->get()->sortByDesc('date')->take(10);

        $pareto = WorkOrder::where(DB::raw('YEAR(date)'), '=', '2020')
        ->leftJoin('positions', 'positions.position', '=', 'work_orders.position')
        ->selectRaw('work_orders.position, count(work_orders.position) as totalworkorders')
        ->where(function($q){
            $q->where('intervention', 1)
              ->orWhere('fix', 1);
        })
        ->orderBy('totalworkorders', 'desc')
        ->groupBy('work_orders.position')
        ->get()
        ->take(15);

        // print_r(json_encode($pareto));
        // die;

        $today = now();

        if ($agent -> isMobile()){
             return view('welcomemobile', compact('workorders', 'myworkorders', 'today', 'pareto'));
        }
        else{
            return view('welcome', compact('workorders', 'myworkorders', 'today', 'pareto'));
        }

    }
}

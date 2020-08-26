<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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

        // dump($_SERVER['PHP_SELF']);
        // dump($_SERVER['SERVER_NAME']);
        // dump($_SERVER['SERVER_SOFTWARE']);
        // dump($_SERVER['REQUEST_METHOD']);
        // dump($_SERVER['HTTP_HOST']);
        // dump($_SERVER['REMOTE_ADDR']);
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        dump($details);
        //dump($_SERVER['REMOTE_HOST']);
        // dump($_SERVER['REMOTE_PORT']);
        // dump($_SERVER['SERVER_SIGNATURE']);
        die;

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
        ->where('planned', 0)
        ->orderBy('totalworkorders', 'desc')
        ->groupBy('work_orders.position')
        ->get()
        ->take(Config::get('sitesettings.pareto'));

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


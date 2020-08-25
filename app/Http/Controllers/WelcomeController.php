<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Position;
use App\WorkOrder;
use App\SparePartOrder;
use App\SparePart;
use App\Info;
use DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $agent = new Agent();
        if(Auth::check()) {
            $user = Auth::user();
        }
        else {
            return redirect('/login')->with('alert', 'Niste ulogovani');
        }

        //
        // MUST UPDATE HOME CONTROLLER!
        //

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

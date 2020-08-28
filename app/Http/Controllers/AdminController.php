<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\UserRole;
use App\WebsiteStatistic;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            $user_role = UserRole::where('id', $user -> id)->first();

            if($user_role -> admin){
                //$last_visits_all = WebsiteStatistic::orderByDesc('created_at')->get()->take(1000)->paginate(15);
                $last_visits = WebsiteStatistic::where('user_id', '<>', 1)->orderByDesc('created_at')->get()->paginate(15);
                $browsers = DB::table('website_statistics')
                    ->select('useragent', DB::raw('count(*) as total'))
                    ->where('user_id', '<>', 1)
                    ->groupBy('useragent')
                    ->get();
                $totalcountmobile = WebsiteStatistic::where('mobile', 1)->where('user_id', '<>', 1)->get()->count();
                $totalcount = WebsiteStatistic::where('user_id', '<>', 1)->get()->count();

                if($totalcount==0){
                    $totalcount=1;
                }

                if($totalcountmobile==0){
                    $totalcountmobile=1;
                }

                return view('admin.index', compact('last_visits', 'browsers', 'totalcountmobile', 'totalcount'));
            }
            else {
                return redirect()->back()->with('alert', 'Nemate pravo pristupa!');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

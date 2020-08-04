<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Position;
use App\SparePartOrder;
use App\SparePart;
use App\Info;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $criticalspareparts = SparePart::where('user_id', $user->id)->where('critical_part', 1)
            ->leftJoin('navision', 'navision.br', '=', 'spare_parts.storage_number')
            ->where('navision.zalihe', '<=', 'spare_part.danger_level')
            ->get(['spare_parts.*', 'navision.br as navbr', 'navision.zalihe as zalihe']);

        $info = Info::first();
        $base = Info::find(2);
        $today = now();

        // print_r(json_encode($criticalspareparts));
        // die;

        if ($agent -> isMobile()){
            return view('welcomemobile', compact('positions', 'sparepartorders', 'info', 'today', 'base'));
        }
        else{
            return view('welcome', compact('positions', 'sparepartorders', 'info', 'today', 'base'));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorkOrder;

class PersonalController extends Controller
{
    public function myworkorders(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect('/login')->with('alert', 'Niste ulogovani');
        }

        $username_raw = explode(" ", $user -> name);
        $username = $username_raw[1]." ".substr($username_raw[0], 0, 1);
        $myworkorders = WorkOrder::where('owner', $username)->get()->sortByDesc('date')->paginate(30);
        $myworkorderscount = WorkOrder::where('owner', $username)->count();

        return view('personal.myworkorders', compact('myworkorders', 'myworkorderscount'));
    }

    public function index()
    {
        //
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

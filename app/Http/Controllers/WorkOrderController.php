<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Position;
use App\UserRole;

class WorkOrderController extends Controller
{
    public function index()
    {
        //
    }

    public function create($position_id)
    {
        if(Auth::check()){
            $user_id = Auth::id();
            $userroles = UserRole::where('user_id', $user_id)->first();
            if($userroles -> workorders_add ==1){
                $position = Position::where('id', $position_id)->with('unit')->with('devicetype')->first();

                // dd($position);
                return view('workorders.create', compact('position'));
            }
            return redirect() -> back() -> with('alert', 'Nemate dozvole za otvaranje novog radnog naloga');
        }
        return redirect() -> back() -> with('alert', 'Niste ulogovani!');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\WorkTime;
use App\UserRole;

class WorkTimeController extends Controller
{
    public function index(Request $request)
    {
        //$user = Auth::check() ? Auth::user() : redirect() -> back() -> with('message', 'Ulogujte se.');
        if(Auth::check()){
            $user = Auth::user();
            $userrole = UserRole::where('user_id', $user -> id)->first();

            if($userrole -> worktimes){
                $items = WorkTime::where('date', Carbon::today())->where('user_id', $user -> id) -> get();
                return view('worktimes.index', compact('items'));
            }
        }
        return redirect() -> back() -> with('alert', 'Nemate pravo pristupa. Kontaktirajte administratora.');
    }

    public function create()
    {
        $user = Auth::check() ? Auth::user() : redirect() -> back() -> with('message', 'Ulogujte se.');
        $items = WorkTime::where('date', Carbon::today())->where('user_id', $user -> id) -> get();

        return view('worktimes.create', compact('items'));
    }

    public function store(Request $request)
    {
        $user = Auth::check() ? Auth::user() : null;

        $request -> validate([
            'description'=>'required'
        ]);


        $regulartime = ($request->get('regulartime')=='on') ? 1 : 0;
        $overtime = ($request->get('overtime')=='on') ? 1 : 0;
        $vacation = ($request->get('vacation')=='on') ? 1 : 0;

        $worktime = new WorkTime([
            'user_id' => $user -> id,
            'date' => $request->get('date'),
            'starttime' => $request->get('starttime'),
            'endtime' => $request->get('endtime'),
            'workorder' => $request->get('workorder'),
            'description' => $request->get('description'),
            'worktime_hours' => $request->get('worktime_hours'),
            'overtime_hours' => $request->get('overtime_hours'),
            'freetime_hours' => $request->get('freetime_hours'),
            'regulartime' => $regulartime,
            'overtime' => $overtime,
            'vacation' => $vacation
        ]);

        $worktime -> save();
        return redirect() -> back() -> with('message', 'Sačuvani radni sati!');
    }

    public function show($id)
    {
        //
    }

    public function review(Request $request)
    {
        $user = Auth::check() ? Auth::user() : redirect() -> back() -> with('message', 'Ulogujte se.');

        $items = WorkTime::whereBetween('date', [$request -> get('startdate'), $request -> get('enddate')])
            ->where('user_id', $user -> id)
            ->get()
            ->groupBy('date');

        return view('worktimes.review', compact('items'));
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

    public function delete($id)
    {
        $worktime = WorkTime::where('id', $id)->first();
        $worktime -> delete();
        return redirect() -> back() -> with('message', 'Obrisana stavka');
    }
}

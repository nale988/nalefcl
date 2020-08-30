<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ToDo;
use App\UserRole;
use Carbon\Carbon;

class ToDoController extends Controller
{
    public function postpone($id){
        $todo = ToDo::where('id', $id)->first();
        $todo -> date = Carbon::parse($todo -> date) -> addDays(2);
        $todo -> save();
        return redirect()->back()->with('warning', 'Odgođen posao za dva dana');
    }

    public function index()
    {
        //
    }

    public function finish($id)
    {
        $todo = ToDo::where('id', $id)->first();
        $todo -> done = 1;
        $todo -> save();

        return redirect()->back()->with('message', 'Uklonjena napomena.');
    }

    public function create()
    {
        $user = Auth::check() ? Auth::user() : redirect() -> back() -> with('message', 'Ulogujte se.');

        $userroles = UserRole::where('user_id', $user -> id)->first();

        if($userroles -> todos){
            return view('todos.create');
        }

        return redirect() -> back() -> with('alert', 'Nemate dozvolu za pristup. Kontaktirajte administartora');
    }

    public function store(Request $request)
    {
        $user = Auth::check() ? Auth::user() : redirect() -> back() -> with('message', 'Ulogujte se.');

        $request -> validate([
            'description' => 'required|max:255',
        ]);

        $urgent = ($request->get('urgent')=='on') ? 1 : 0;

        $todo = new ToDo([
            'date' => $request -> get('date'),
            'user_id' => $user -> id,
            'description' => $request -> get('description'),
            'urgent' => $urgent,
            'done' => '0'
        ]);

        $todo -> save();
        return redirect() -> back() -> with('message', 'Sačuvana nova napomena za posao!');
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

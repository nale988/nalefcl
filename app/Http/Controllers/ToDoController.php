<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ToDo;
use Carbon\Carbon;

class ToDoController extends Controller
{
    public function postpone($id){
        $todo = ToDo::where('id', $id)->first();
        $todo -> date = Carbon::parse($todo -> date) -> addDays(2);
        $todo -> save();
        return redirect()->back()->with('message', 'Odgođen posao za dva dana');
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

        return view('todos.create');
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

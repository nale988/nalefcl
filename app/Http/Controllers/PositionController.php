<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

use DB;
use Carbon\Carbon;
use App\User;
use App\Position;
use App\SparePart;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all()->sortBy('position')->paginate(20);
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $position = Position::where('id', $id)
            ->with('unit')
            ->with('devicetype')
            ->with('spareparts')
            ->get()->first();

        print_r(json_encode($position));
        die;

        Auth::check() ? $user=Auth::user() : $user=User::where('id', 12)->first();

        return view('positions.show', compact('position', 'user'));
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

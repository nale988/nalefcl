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
use App\SparePartConnection;

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

        if(Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect()->guest('login')->with('alert', 'Niste ulogovani!');;
        }

        $spareparts = SparePartConnection::where('position_id', $id)
            ->leftJoin('spare_parts', 'spare_parts.id', '=', 'spare_part_connections.spare_part_id')
            ->leftJoin('users', 'spare_parts.user_id', '=', 'users.id')->where('users.id', '=', $user->id)
            ->leftJoin('navision', 'navision.br', '=', 'spare_parts.storage_number')
            ->leftJoin('spare_part_types', 'spare_part_types.id', '=', 'spare_parts.spare_part_type_id')
            ->get(['spare_parts.*', 'navision.zalihe as zalihe', 'navision.kol_na_narudzbenici as naruceno', 'navision.jedinicni_trosak as jedinicni_trosak', 'spare_part_connections.amount as amount', 'spare_part_types.description as spare_part_type_description'])
            ->groupBy('spare_part_group');
        // print_r(json_encode($spareparts));
        // die;


        return view('positions.show', compact('position', 'spareparts', 'user'));
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

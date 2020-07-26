<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


use App\Position;
use App\SparePart;
use App\SparePartConnection;
use App\Unit;
use App\User;
use App\File;
use App\DeviceType;
use App\SparePartType;

class SparePartController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $positions = Position::with('unit')->get()->sortBy('unit.unit_number')->groupBy('unit.unit_number');
        $spareparttypes = SparePartType::all()->sortBy('description');

        // print_r(json_encode($spareparttype));
        // die;

        return view('spareparts.create', compact('positions', 'spareparttypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'storage_number' => 'required',
            'description' => 'required'
        ]);

        $critpart = $request->get('critical_part');
        if (isset($critpart)){
            $critical_part = 1;
        }
        else{
            $critical_part = 0;
        }

        Auth::check() ? $user=Auth::user() : $user=User::where('id', 12)->first();

        if (Auth::check()){
            $user = Auth::user();
        }

        $sparepart = new SparePart([
            'description' => $request->get('description'),
            'catalogue_number' => $request->get('catalogue_number'),
            'storage_number' => $request->get('storage_number'),
            'info' => $request->get('info'),
            'spare_part_group' => $request->get('spare_part_group'),
            'position' => $request->get('drawing_position'),
            'unit' => $request->get('unit'),
            'danger_level' => $request->get('danger_level'),
            'critical_part' => $critical_part,
            'spare_part_type_id' => $request -> get('spareparttype'),
            'user_id' => $user -> id
        ]);

        $sparepart -> save();
        $sparepart_id = $sparepart -> id;

        $items_raw = collect($request);
        foreach($items_raw as $key => $value){
            $item = explode('-', $key);
            if ($item[0] == 'checkbox'){
                $connection = new SparePartConnection([
                    'position_id' => $item[1],
                    'spare_part_id' => $sparepart_id,
                    'amount' => $request -> get('amount')
                ]);

                $connection -> save();
            }
        }

        return redirect()->back()->with('message', 'Sačuvan novi rezervni dio!');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\SparePart;
use App\Unit;
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
        $spareparttypes = SparePartType::all();

        // print_r(json_encode($spareparttype));
        // die;

        return view('spareparts.create', compact('positions', 'spareparttypes'));
    }

    public function store(Request $request)
    {
        print_r(json_encode($request->all()));
        die;
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

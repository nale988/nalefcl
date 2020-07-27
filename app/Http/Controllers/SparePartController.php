<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;


use App\Position;
use App\SparePart;
use App\SparePartFile;
use App\SparePartConnection;
use App\FileUpload;
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

        if (Auth::check()){
            $user = Auth::user();
        }
        else{
            return view('/')->with('danger', 'Niste ulogovani!');
        }

        // save spare part
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

        // save connection with position
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

        // save file
        $userfolder_raw = explode('@', $user -> email);
        $userfolder = str_replace('.', '', $userfolder_raw[0]);

        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:2048',
                    'document.*' => 'required|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:10245',
                ]);

                $extension = $request->file->extension();
                $request->file->storeAs('public/sp/'.$userfolder, $request->file->hashName());

                $url = Storage::disk('sparepartfiles')->url($userfolder.'/'.$request->file->hashName());

                $filesize = $request->file('file')->getSize();

                $document = new FileUpload([
                    'user_id' => $user->id,
                    'filename' => $request -> file -> getClientOriginalName(),
                    'filesize' => $filesize,
                    'url' => $url,
                ]);

                $document -> save();
                $document_id = $document->id;

                $connectfile = new SparePartFile([
                    'spare_part_id' => $sparepart_id,
                    'file_upload_id' => $document_id
                ]);

                $connectfile -> save();
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

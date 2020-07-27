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
    public function removesparepartfile(Request $request){
        foreach($request->all() as $key => $value){
            $file = SparePartFile::where('id', $key)->delete();
        }

        return redirect() -> back() -> with('message', 'Uklonjen dokument!');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $positions = Position::with('unit')->get()->sortBy('unit.unit_number')->groupBy('unit.unit_number');
        $spareparttypes = SparePartType::all()->sortBy('description');

        return view('spareparts.create', compact('positions', 'spareparttypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'storage_number' => 'required',
            'description' => 'required'
        ]);

        $critpart = $request->get('critical_part');
        if ($critpart=='on'){
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
        $sparepart = SparePart::where('id', $id)->first();
        $positions = Position::with('unit')->get()->sortBy('unit.unit_number')->groupBy('unit.unit_number');
        $spareparttypes = SparePartType::all()->sortBy('description');

        $selected_positions = SparePartConnection::where('spare_part_id', $id)->get();
        $file = SparePartFile::where('spare_part_id', $id)
            ->leftJoin('file_uploads', 'file_uploads.id', '=', 'spare_part_files.file_upload_id')
            ->get(['spare_part_files.id as id', 'spare_part_files.file_upload_id as file_upload_id', 'spare_part_files.spare_part_id as spare_part_id', 'file_uploads.filename as filename', 'file_uploads.filesize as filesize', 'file_uploads.url as url']);

        // print_r(json_encode($selected_positions));
        // die;

        return view('spareparts.edit', compact('sparepart', 'positions', 'spareparttypes', 'selected_positions', 'file'));
    }

    public function update(Request $request, $id)
    {
        // print_r(json_encode($request->all()));
        // die;

        $request->validate([
            'storage_number' => 'required',
            'description' => 'required'
        ]);

        $critpart = $request->get('critical_part');
        if ($critpart=='on'){
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

        // spare part itself
        $sparepart = SparePart::where('id', $id)->first();
        $sparepart -> storage_number = $request->get('storage_number');
        $sparepart -> description = $request->get('description');
        $sparepart -> catalogue_number = $request->get('catalogue_number');
        $sparepart -> spare_part_group = $request->get('spare_part_group');
        $sparepart -> info = $request->get('info');
        $sparepart -> position = $request->get('drawing_position');
        $sparepart -> unit = $request->get('unit');
        $sparepart -> danger_level = $request->get('danger_level');
        $sparepart -> spare_part_type_id = $request->get('spareparttype');
        $sparepart -> critical_part = $critical_part;
        $sparepart -> save();

        // connections
        $sparepartconnections = SparePartConnection::where('spare_part_id', $id)->get();
        foreach($sparepartconnections as $sparepartconnection){
            $sparepartconnection -> delete();
        }

        // positions
        $items_raw = collect($request);
        foreach($items_raw as $key => $value){
            $item = explode('-', $key);
            if ($item[0] == 'checkbox'){
                $connection = new SparePartConnection([
                    'position_id' => $item[1],
                    'spare_part_id' => $id,
                    'amount' => $request -> get('amount')
                ]);

                $connection -> save();
            }
        }

        // file
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
                    'spare_part_id' => $id,
                    'file_upload_id' => $document_id
                ]);

                $connectfile -> save();
            }
        }

        return redirect()->back()->with('message', 'Izmijenjeni podaci na rezervnom dijelu!');
        print_r(json_encode($sparepartconnections));
        die;
    }

    public function destroy($id)
    {
        //
    }
}

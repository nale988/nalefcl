<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;
use Session;

use App\User;
use App\Position;
use App\Revision;
use App\SparePartConnection;
use App\FileUpload;
use App\PositionFile;
use App\WorkOrder;
use App\Unit;

class PositionController extends Controller
{
    public function workorder($id){
        //$agent = new Agent();

        // if (Auth::check()){
        //     $user = Auth::user();
        // }
        // else{
        //     return redirect() -> back() -> with('danger', 'Niste ulogovani!');
        // }

        $workorder = WorkOrder::where('id', $id)->first();
        $position = Position::where('position', 'LIKE', $workorder -> position)->first();
        $units = Unit::find($position -> unit)->first();
        // print_r(json_encode($units));
        // die;


        // if ($agent -> isMobile()){
        //     return view('positions.workordermobile', compact('workorder', 'position', 'units'));
        // }
        // else {
        //     return view('positions.workorder', compact('workorder', 'position', 'units'));
        // }
        return view('positions.workorder', compact('workorder', 'position', 'units'));
    }

    public function workorders($position){
        $agent = new Agent();

        if (Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect() -> back() -> with('danger', 'Niste ulogovani!');
        }

        $workorders = WorkOrder::where('position', 'LIKE', $position)->get()->sortByDesc('date');
        // print_r(json_encode($workorders));
        // die;
        if ($agent -> isMobile()){
            return view('positions.workordersmobile', compact('workorders'));
        }
        else {
            return view('positions.workorders', compact('workorders'));
        }
    }

    public function removepositionfile (Request $request){
        foreach($request->all() as $key => $value){
            $file = PositionFile::where('id', $key)->delete();
        }

        return redirect() -> back() -> with('message', 'Uklonjen dokument!');
    }

    public function uploadpositionfile(Request $request){
        if (Auth::check()){
            $user = Auth::user();
        }
        else{
            return view('positions/'.$request -> get('position_id'))->with('danger', 'Niste ulogovani!');
        }

        $userfolder_raw = explode('@', $user -> email);
        $userfolder = str_replace('.', '', $userfolder_raw[0]);

        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:2048',
                    'document.*' => 'required|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:10245',
                ]);

                $extension = $request->file->extension();
                $request->file->storeAs('public/po/'.$userfolder, $request->file->hashName());

                $url = Storage::disk('positionfiles')->url($userfolder.'/'.$request->file->hashName());

                $filesize = $request->file('file')->getSize();

                $document = new FileUpload([
                    'user_id' => $user->id,
                    'filename' => $request -> file -> getClientOriginalName(),
                    'filesize' => $filesize,
                    'url' => $url,
                ]);

                $document -> save();
                $document_id = $document->id;

                $connectfile = new PositionFile([
                    'position_id' => $request -> get('position_id'),
                    'file_upload_id' => $document_id
                ]);

                $connectfile -> save();
            }
        }

        return redirect('positions/'.$request -> get('position_id'))->with('message', 'Dodan novi dokument na poziciju!');
    }
    public function index()
    {
        $agent = new Agent();

        $positions = Position::all()->sortBy('position')->paginate(20);
        if ($agent -> isMobile()){
            return view('positions.indexmobile', compact('positions'));
        }
        else{
            return view('positions.index', compact('positions'));
        }
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
        $agent = new Agent();
        $position = Position::where('id', $id)
            ->with('unit')
            ->with('devicetype')
            ->with('spareparts')
            ->with('files')
            ->get()->first();

        $workorders = WorkOrder::where('position', 'LIKE', $position -> position)->get()->sortByDesc('date');
        //  print_r(json_encode($workorders));
        //  die;

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
            ->leftJoin('spare_part_files', 'spare_part_files.spare_part_id', '=', 'spare_parts.id')
            ->leftJoin('file_uploads', 'file_uploads.id', '=', 'spare_part_files.file_upload_id')
            ->leftJoin('spare_part_group_connections', 'spare_parts.id', '=', 'spare_part_group_connections.spare_part_id')
            ->leftJoin('spare_part_groups', 'spare_part_group_connections.spare_part_group_id', '=', 'spare_part_groups.id')
            ->get(['spare_parts.*',
                'navision.zalihe as navision_zalihe',
                'navision.kol_na_narudzbenici as navision_kol_na_narudzebnici',
                'spare_part_connections.amount as amount',
                'spare_part_groups.description as spare_part_group_description',
                'file_uploads.filename as file_filename',
                'file_uploads.filesize as file_filesize',
                'file_uploads.url as file_fileurl',
                'spare_part_types.description as spare_part_type_description'
                ])
            ->sortBy('spare_parts.position')
            ->sortBy('spare_part_group_description')
            ->groupBy('spare_part_group_description');

        // $spareparts = SparePartConnection::where('position_id', $id)
        //     ->leftJoin('spare_parts', 'spare_parts.id', '=', 'spare_part_connections.spare_part_id')
        //     ->leftJoin('users', 'spare_parts.user_id', '=', 'users.id')->where('users.id', '=', $user ->id)
        //     ->leftJoin('spare_part_types', 'spare_part_types.id', '=', 'spare_parts.spare_part_type_id')
        //     ->get()
        //     ->groupBy('spare_part_group');

        $revisions = Revision::where('position_id', $id)->with('files')->get();

        // print_r(json_encode($spareparts));
        // die;

        if ($agent -> isMobile()){
            return view('positions.showmobile', compact('position', 'spareparts', 'revisions', 'workorders', 'user'));
        }
        else{
            return view('positions.show', compact('position', 'spareparts', 'revisions', 'workorders', 'user'));
        }
    }

    public function edit($id)
    {

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

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
use DB;
use App\Position;
use App\Revision;
use App\SparePartConnection;
use App\FileUpload;
use App\PositionFile;
use App\WorkOrder;
use App\StorageSpending;
use App\CompressorWorkingHour;
use App\Unit;
use App\UserRole;
use App\BlowerService;
use App\CompressorService;
use App\CompressorServiceFile;
use App\Favorite;

class PositionController extends Controller
{
    public function favorite($id){
        $user = Auth::user();
        $favorite = Favorite::where('position_id', $id)->first();

        if(!empty($favorite)){
            $favorite -> delete();
            return redirect()->back()->with('alert', 'Uklonjena pozicija iz omiljenih!');
        }
        else{
            $add = new Favorite([
                'user_id' => $user -> id,
                'position_id' => $id,
            ]);

            $add -> save();
            return redirect()->back()->with('message', 'Dodana pozicija u omiljene!');
        }
    }
    public function storecompressorservice(Request $request){
        $request -> validate([
            'date' => 'required',
            'total' => 'required',
            'type' => 'required'
        ]);

        $user = Auth::user();

        $service = new CompressorService([
            'position_id' => $request -> get('position_id'),
            'user_id' => $user -> id,
            'date' => $request -> get('date'),
            'total' => $request -> get('total'),
            'type' => $request -> get('type'),
            'comment' => $request -> get('comment'),
        ]);

        $service -> save();

        $service_id = $service -> id;
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

                $connectfile = new CompressorServiceFile([
                    'compressor_service_id' => $service_id,
                    'file_upload_id' => $document_id
                ]);

                $connectfile -> save();
            }
        }
        return redirect()->back()->with('message', 'Sačuvan servis kompresora!');
    }

    public function storeblowerservice(Request $request){
        $request -> validate([
            'date' => 'required',
        ]);

        $user = Auth::user();

        $service = new BlowerService([
            'position_id' => $request -> get('position_id'),
            'user_id' => $user -> id,
            'date' => $request -> get('date'),
            'inspection' => $request -> get('inspection'),
            'filter' => $request -> get('filter'),
            'belt' => $request -> get('belt'),
            'pulley' => $request -> get('pulley'),
            'nonreturn_valve' => $request -> get('nonreturn_valve'),
            'element_repair' => $request -> get('element_repair'),
            'element_replace' => $request -> get('element_replace'),
            'first_start' => $request -> get('first_start'),
            'other' => $request -> get('other'),
            'comment' => $request -> get('comment'),
        ]);

        $service -> save();
        return redirect()->back()->with('message', 'Sačuvan servis duvaljke!');
    }

    public function storeworkinghours(Request $request){
        $request->validate([
            'total' => 'required|integer',
            'loaded' => 'required|integer',
            'date' => 'required|date'
        ]);

        $user = Auth::user();

        $workinghour = new CompressorWorkingHour([
            'position_id' => $request -> get('position_id'),
            'total' =>  $request -> get('total'),
            'loaded' =>  $request -> get('loaded'),
            'starts' =>  $request -> get('starts'),
            'comment' =>  $request -> get('comment'),
            'date' => $request -> get('date'),
            'user_id' => $user -> id,
        ]);

        $workinghour -> save();
        return redirect()->back()->with('message', 'Sačuvani radni sati!');
    }

    public function workorder($id){
        $workorder = WorkOrder::where('id', $id)->first();
        $position = Position::where('position', 'LIKE', $workorder -> position)->first();

        if(!empty($position)){
            // ponekad neko stavi nepostojeću poziciju kao unos...
            // TODO: popraviti!
            $unit = Unit::find($position -> unit)->first();
            $storagespendings = StorageSpending::where('workorder_number', $workorder->number)->get()->sortBy('storage_number');
        }
        else{
            $position = (object)[
                'id' => 9999,
                'position' => 'greška',
                'unit_id' => 9999,
                'name' => 'greška',
                'type' => 'greška',
                'manufacturer' => 'greška',
                'unit' => [
                        'unit_number' => '9999',
                        'description' => 'greška'],
                ];

            // TODO: sortirati za grupu...
            $unit = Unit::find(1);
            $storagespendings = collect();
        }

        // TODO:
        // Uraditi za mobilni i obični?
        return view('positions.workorder', compact('workorder', 'position', 'unit', 'storagespendings'));
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
        $selectedposition = Position::where('position', 'LIKE', $position)->first();

        if ($agent -> isMobile()){
            return view('positions.workordersmobile', compact('workorders', 'selectedposition'));
        }
        else {
            return view('positions.workorders', compact('workorders', 'selectedposition'));
        }
    }

    public function removepositionfile($id){
        $files = PositionFile::where('file_upload_id', $id)->get();
        foreach($files as $file){
            $file -> delete();
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

        print_r(json_encode($positions));
        die;

        if ($agent -> isMobile()){
            return view('positions.indexmobile', compact('positions'));
        }
        else{
            return view('positions.index', compact('positions'));
        }
    }

    public function show($id)
    {
        $agent = new Agent();

        if(Auth::check()){
            $user = Auth::user();
            $userrole = UserRole::where('user_id', $user->id)->first();
        }
        else{
            return redirect()->guest('login')->with('alert', 'Niste ulogovani!');;
        }

        $position = Position::where('id', $id)
            ->with('unit')
            ->with('devicetype')
            ->with('spareparts')
            ->get()->first();

        $favorite = Favorite::where('position_id', $id)->where('user_id', $user -> id)->first();
        $workorders = WorkOrder::where('position', 'LIKE', $position -> position)->get()->sortByDesc('date');

        if($userrole -> workhours){
            $workinghours = CompressorWorkingHour::where('position_id', $id)->where('user_id', $user->id)->get()->sortByDesc('date');
            $lastworkinghours = CompressorWorkingHour::where('position_id', $id)->where('user_id', $user->id)->get()->sortByDesc('date')->take(1)->first();
        }
        else{
            $workinghours = collect();
            $lastworkinghours = collect();
        }

        if($userrole -> services){
            $compressorservices = CompressorService::where('position_id', $id)->where('user_id', $user->id)->with('files')->get()->sortByDesc('date');
            $blowerservices = BlowerService::where('position_id', $id)->where('user_id', $user->id)->get()->sortByDesc('date');
        }
        else{
            $compressorservices = collect();
            $blowerservices = collect();
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
                'navision.jedinicni_trosak as navision_jedinicni_trosak',
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

        $revisions = Revision::where('position_id', $id)->where('user_id', $user->id)->with('files')->get();

        if ($agent -> isMobile()){
            return view('positions.showmobile', compact('position', 'favorite', 'spareparts', 'revisions', 'workorders', 'workinghours', 'lastworkinghours', 'compressorservices', 'blowerservices', 'user', 'userrole'));
        }
        else{
            return view('positions.show', compact('position', 'spareparts', 'favorite', 'revisions', 'workorders', 'workinghours', 'lastworkinghours', 'compressorservices', 'blowerservices', 'user', 'userrole'));
        }
    }
}

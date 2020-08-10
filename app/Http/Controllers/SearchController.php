<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Position;
use App\SparePart;
use App\SparePartType;
use App\FileUpload;
use App\Revision;
use App\Info;

class SearchController extends Controller
{
    public function search(Request $request){
        $agent = new Agent();

        $searchresults = Position::where('position', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('name', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('type', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('manufacturer', 'LIKE', '%'.$request->searchvalue.'%')
            ->with('unit')
            ->get()
            ->sortBy('position');

        if ($agent -> isMobile()){
            return view('search.searchmobile', compact('searchresults'));
        }
        else{
            return view('search.search', compact('searchresults'));
        }
    }

    public function advancedsearch(Request $request){
        return view('search.advancedsearch');
    }

    public function advancedsearchresults(Request $request){
        $agent = new Agent();

        if (Auth::check()){
            $user = Auth::user();
        }
        else{
            return view('/');
        }

        $positions = collect();
        $spareparts = collect();
        $spareparttypes = collect();
        $files = collect();
        $revisions = collect();
        $navisions = collect();

        $info = Info::first(); // navision date

        $item_raw = collect($request->all());

        foreach($item_raw as $key => $value){
            if ($key == 'search-positions'){
                $positions = Position::where('position', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('name', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('type', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('manufacturer', 'LIKE', '%'.$request->searchvalue.'%')
                    ->with('unit')
                        ->get();
            }
            else if($key == 'search-spareparts'){
                $spareparts = SparePart::where('description', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('catalogue_number', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('storage_number', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('spare_part_group', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('info', 'LIKE', '%'.$request->searchvalue.'%')
                        ->with('spareparttype')
                        ->where('user_id', $user -> id)
                        ->get();
            }
            else if($key == 'search-spareparttypes'){
                // TODO: provjeriti ovaj dio - ne vraća ništa.
                $spareparttypes = SparePartType::where('description', 'LIKE', '%'.$request->searchvalue.'%')
                    ->with('spareparts')
                        ->get();
            }
            else if($key == 'search-files'){
                $files = FileUpload::where('filename', 'LIKE', '%'.$request->searchvalue.'%')
                    ->where('user_id', $user -> id)
                    ->get();
            }

            else if($key == 'search-revisions'){
                $revisions = Revision::where('description', 'LIKE', '%'.$request->searchvalue.'%')
                    ->where('user_id', $user -> id)
                    ->with('position')
                    ->get();
            }

            else if($key == 'search-navision'){
                $navisions = DB::table('navision')
                    ->where('br', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('opis', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('opis_2', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('opis_pretrazivanja', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('opis_pretrazivanja_1', 'LIKE', '%'.$request->searchvalue.'%')
                    ->orWhere('opis_pretrazivanja_2', 'LIKE', '%'.$request->searchvalue.'%')
                    ->get();
            }
        }

         // print_r(json_encode($spareparttypes));
         // die;

        if ($agent -> isMobile()){
            return view('search.advancedsearchresultsmobile', compact('positions', 'spareparts', 'files', 'revisions', 'navisions', 'info'));
        }
        else{
            return view('search.advancedsearchresultsmobile', compact('positions', 'spareparts', 'files', 'revisions', 'navisions', 'info'));
        }
    }
}

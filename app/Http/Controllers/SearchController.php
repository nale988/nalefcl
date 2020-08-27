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
        $user = Auth::check() ? Auth::user() : redirect() -> back() -> with('message', 'Ulogujte se.');

        if(($request->searchvalue) == NULL || isset($request->searchvalue) || trim($request->searchvalue)===""){
            redirect() -> back() -> with('danger', 'Unesite traženi pojam.');
        }

        $searchvalue = '%'.implode("%", str_split(str_replace(" ", "", $request->searchvalue))).'%';

        if($request -> get('searchwhere') == 'position'){
            $searchresults = Position::where('position', 'LIKE', $searchvalue)
            ->orWhere('name', 'LIKE', $searchvalue)
            ->orWhere('type', 'LIKE', $searchvalue)
            ->orWhere('manufacturer', 'LIKE', $searchvalue)
            ->with('unit')
            ->get()
            ->sortBy('position');

            return view('search.search_positions', compact('searchresults'));
        }

        if($request -> get('searchwhere') == 'spareparts'){
            $searchresults = SparePart::where('description', 'LIKE', $searchvalue)
                    ->orWhere('catalogue_number', 'LIKE', $searchvalue)
                    ->orWhere('storage_number', 'LIKE', $searchvalue)
                    ->orWhere('spare_part_group', 'LIKE', $searchvalue)
                    ->orWhere('info', 'LIKE', $searchvalue)
                        ->with('spareparttype')
                        ->where('user_id', $user -> id)
                        ->get();

            return view('search.search_spareparts', compact('searchresults'));
        }

        if($request -> get('searchwhere') == 'spareparttypes'){
            $searchresults = SparePartType::where('description', 'LIKE', $searchvalue)
            ->with('spareparts')
                ->get();

            return view('search.search_spareparttypes', compact('searchresults'));
        }

        if($request -> get('searchwhere') == 'documents'){
            $searchresults = FileUpload::where('filename', 'LIKE', $searchvalue)
            ->where('user_id', $user -> id)
            ->get();
            return view('search.search_documents', compact('searchresults'));
        }

        if($request -> get('searchwhere') == 'revisions'){
            $searchresults = Revision::where('description', 'LIKE', $searchvalue)
            ->where('user_id', $user -> id)
            ->with('position')
            ->get();

            return view('search.search_revisions', compact('searchresults'));
        }

        if($request -> get('searchwhere') == 'navision'){
            $searchresults = DB::table('navision')
            ->where('br', 'LIKE', $searchvalue)
            ->orWhere('opis', 'LIKE', $searchvalue)
            ->orWhere('opis_2', 'LIKE', $searchvalue)
            ->orWhere('opis_pretrazivanja', 'LIKE', $searchvalue)
            ->orWhere('opis_pretrazivanja_1', 'LIKE', $searchvalue)
            ->orWhere('opis_pretrazivanja_2', 'LIKE', $searchvalue)
            ->get();

            return view('search.search_navision', compact('searchresults'));
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

        $item_raw = collect($request->all());
        $searchvalue = '%'.implode("%", str_split(str_replace(" ", "", $request->searchvalue))).'%';

        foreach($item_raw as $key => $value){
            if ($key == 'search-positions'){
                $positions = Position::where('position', 'LIKE', $searchvalue)
                    ->orWhere('name', 'LIKE', $searchvalue)
                    ->orWhere('type', 'LIKE', $searchvalue)
                    ->orWhere('manufacturer', 'LIKE', $searchvalue)
                    ->with('unit')
                        ->get();
            }
            else if($key == 'search-spareparts'){
                $spareparts = SparePart::where('description', 'LIKE', $searchvalue)
                    ->orWhere('catalogue_number', 'LIKE', $searchvalue)
                    ->orWhere('storage_number', 'LIKE', $searchvalue)
                    ->orWhere('spare_part_group', 'LIKE', $searchvalue)
                    ->orWhere('info', 'LIKE', $searchvalue)
                        ->with('spareparttype')
                        ->where('user_id', $user -> id)
                        ->get();
            }
            else if($key == 'search-spareparttypes'){
                $spareparttypes = SparePartType::where('description', 'LIKE', $searchvalue)
                    ->with('spareparts')
                        ->get();
            }
            else if($key == 'search-files'){
                $files = FileUpload::where('filename', 'LIKE', $searchvalue)
                    ->where('user_id', $user -> id)
                    ->get();
            }

            else if($key == 'search-revisions'){
                $revisions = Revision::where('description', 'LIKE', $searchvalue)
                    ->where('user_id', $user -> id)
                    ->with('position')
                    ->get();
            }

            else if($key == 'search-navision'){
                $navisions = DB::table('navision')
                    ->where('br', 'LIKE', $searchvalue)
                    ->orWhere('opis', 'LIKE', $searchvalue)
                    ->orWhere('opis_2', 'LIKE', $searchvalue)
                    ->orWhere('opis_pretrazivanja', 'LIKE', $searchvalue)
                    ->orWhere('opis_pretrazivanja_1', 'LIKE', $searchvalue)
                    ->orWhere('opis_pretrazivanja_2', 'LIKE', $searchvalue)
                    ->get();
            }
        }

        if ($agent -> isMobile()){
            return view('search.advancedsearchresultsmobile', compact('positions', 'spareparts', 'files', 'revisions', 'navisions', 'spareparttypes'));
        }
        else{
            return view('search.advancedsearchresults', compact('positions', 'spareparts', 'files', 'revisions', 'navisions', 'spareparttypes'));
        }
    }
}

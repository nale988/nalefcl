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
    public function searchposition($searchquery){
        $user = Auth::check() ? Auth::user() : redirect() -> back() -> with('message', 'Ulogujte se.');

        if(($searchquery) == NULL || isset($searchquery) || trim($searchquery)===""){
            redirect() -> back() -> with('danger', 'Unesite traženi pojam.');
        }

        $searchvalue = '%'.implode("%", str_split(str_replace(" ", "", $searchquery))).'%';

        $searchresults = Position::where('position', 'LIKE', $searchvalue)
            ->orWhere('name', 'LIKE', $searchvalue)
            ->orWhere('type', 'LIKE', $searchvalue)
            ->orWhere('manufacturer', 'LIKE', $searchvalue)
            ->with('unit')
            ->get()
            ->sortBy('position');

        if(count($searchresults)==1){
            return redirect() -> route('positions.show', $searchresults->first()->id);
        }
        else{
            return view('search.search_positions', compact('searchresults', 'searchquery'));
        }
    }
    public function search(Request $request){
        $user = Auth::check() ? Auth::user() : redirect() -> back() -> with('message', 'Ulogujte se.');

        $searchquery = $request->searchvalue;

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

            if(count($searchresults)==1){
                return redirect() -> route('positions.show', $searchresults->first()->id);
            }
            else{
                return view('search.search_positions', compact('searchresults', 'searchquery'));
            }
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

            return view('search.search_spareparts', compact('searchresults', 'searchquery'));
        }

        if($request -> get('searchwhere') == 'spareparttypes'){
            $searchresults = SparePartType::where('description', 'LIKE', $searchvalue)
            ->with('spareparts')
                ->get();

            return view('search.search_spareparttypes', compact('searchresults', 'searchquery'));
        }

        if($request -> get('searchwhere') == 'documents'){
            $searchresults = FileUpload::where('filename', 'LIKE', $searchvalue)
            ->where('user_id', $user -> id)
            ->get();
            return view('search.search_documents', compact('searchresults', 'searchquery'));
        }

        if($request -> get('searchwhere') == 'revisions'){
            $searchresults = Revision::where('description', 'LIKE', $searchvalue)
            ->where('user_id', $user -> id)
            ->with('position')
            ->get();

            return view('search.search_revisions', compact('searchresults', 'searchquery'));
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

            return view('search.search_navision', compact('searchresults', 'searchquery'));
        }
    }
}

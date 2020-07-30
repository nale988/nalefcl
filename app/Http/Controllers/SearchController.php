<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;

use App\Position;
use App\SparePart;
use App\SparePartType;
use App\FileUpload;
use App\Revision;

class SearchController extends Controller
{
    public function search(Request $request){
        $agent = new Agent();

        $searchresults = Position::where('position', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('name', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('type', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('manufacturer', 'LIKE', '%'.$request->searchvalue.'%')
            ->with('unit')
                ->get();

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
        }

        // print_r(json_encode($revisions));
        // die;

        if ($agent -> isMobile()){
            return view('search.advancedsearchresultsmobile', compact('positions', 'spareparts', 'files', 'revisions'));
        }
        else{
            return view('search.advancedsearchresults', compact('positions', 'spareparts', 'files', 'revisions'));
        }
    }
}

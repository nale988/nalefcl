<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\SparePart;
use App\SparePartType;

class SearchController extends Controller
{
    public function search(Request $request){
        $searchresults = Position::where('position', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('name', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('type', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('manufacturer', 'LIKE', '%'.$request->searchvalue.'%')
            ->with('unit')
                ->get();

        return view('search.search', compact('searchresults'));
    }

    public function advancedsearch(Request $request){
        $positions = Position::all();
        return view('search.advancedsearch', compact('positions'));
    }

    public function advancedsearchresults(Request $request){
        $positions = collect();
        $spareparts = collect();
        $spareparttypes = collect();
        $files = collect();
        $revisions = collect();
        $searchtype = "";

        $positions = Position::where('position', 'LIKE', '%'.$request->searchvalue.'%')
        ->orWhere('name', 'LIKE', '%'.$request->searchvalue.'%')
        ->orWhere('type', 'LIKE', '%'.$request->searchvalue.'%')
        ->orWhere('manufacturer', 'LIKE', '%'.$request->searchvalue.'%')
        ->with('unit')
            ->get();

        $spareparts = SparePart::where('description', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('catalogue_number', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('storage_number', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('spare_part_group', 'LIKE', '%'.$request->searchvalue.'%')
            ->orWhere('info', 'LIKE', '%'.$request->searchvalue.'%')
                ->with('spareparttype')
                ->get();

        $spareparttypes = SparePartType::where('description', 'LIKE', '%'.$request->searchvalue.'%')
        ->with('spareparts')
        ->get();

        $item_raw = collect($request->all());
        foreach($item_raw as $key => $value){
            $searchtype = $searchtype.($key == 'search-positions' ? "pos1#" : "");
            $searchtype = $searchtype.($key == 'search-spareparts' ? "spa1#" : "");
            $searchtype = $searchtype.($key == 'search-spareparttypes' ? "typ1#" : "");
            $searchtype = $searchtype.($key == 'search-files' ? "fil1#" : "");
            $searchtype = $searchtype.($key == 'search-revisions' ? "rev1#" : "");
        }

        return view('search.advancedsearchresults', compact('positions', 'spareparts', 'files', 'revisions', 'searchtype'));
    }
}

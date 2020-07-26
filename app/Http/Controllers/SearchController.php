<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\SparePart;


class SearchController extends Controller
{
    public function search(Request $request){
        $searchresults = Position::where('position', 'LIKE', $request->searchvalue.'%')
            ->orWhere('name', 'LIKE', $request->searchvalue.'%')
            ->orWhere('type', 'LIKE', $request->searchvalue.'%')
            ->orWhere('manufacturer', 'LIKE', $request->searchvalue.'%')
            ->with('unit')
                ->get();

        //print_r(json_encode($searchresults));
        //die;
        return view('search.search', compact('searchresults'));
    }

    public function advancedsearch(Request $request){
        $positions = Position::all();
        return view('search.advancedsearch', compact('positions'));
    }

    public function advancedsearchresults(Request $request){
        $item_raw = collect($request->all());
        foreach($item_raw as $key => $value){
            if($key == 'search-positions'){

            }

            if($key == 'search-spareparts'){

            }

            if($key == 'search-files'){

            }

            if($key == 'search-revisions'){

            }
        }
    }
}

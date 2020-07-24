<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;

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
        return view('positions.search', compact('searchresults'));
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

use App\SparePart;
use App\UserRole;
use App\Position;
use App\SparePartOrder;

class SparePartOrderController extends Controller
{
    public function confirmorder($sparepartorder_id){
        $sparepartorder = SparePartOrder::where('id', $sparepartorder_id)->first();
        $sparepartorder -> done = 1;
        $sparepartorder -> save();

        $sparepart = SparePart::where('id', $sparepartorder -> spare_part_id)->first();

        $message = 'Potvrđena narudžba: '.$sparepart -> description;

        return redirect()->back()->with('message', $message);
    }

    public function neworder($position_id, $spare_part_id, $amount){
        if(Auth::check()){
            $user = Auth::user();
            $userrole = UserRole::where('user_id', $user->id)->first();

            $sparepart = SparePart::where('id', $spare_part_id)->first();
            $position = Position::where('id', $position_id)->first();

            return view('sparepartorders.neworder', compact('position', 'sparepart', 'amount'));
        };
        return view('/')->with('danger', 'Nemate dozvole za ovo. Kontaktirajte administratora.');
    }

    public function index()
    {
        $agent = new Agent();
        if (Auth::check()){
            $user = Auth::user();
            $userrole = UserRole::where('user_id', $user->id)->first();
            if($userrole -> spare_parts_order){
                $sparepartorders = SparePartOrder::where('user_id', $user -> id) -> where('done', 0)->with('sparepart')->with('position')->orderBy('date')->get();
                $today = now();
                if ($agent -> isMobile()){
                    return view('sparepartorders.mobileindex', compact('sparepartorders', 'today'));
                }
                else{
                    return view('sparepartorders.index', compact('sparepartorders', 'today'));
                }
            }
            return view('/')->with('danger', 'Nemate dozvole za ovo. Kontaktirajte administratora.');
        }

        return view('/')->with('danger', 'Niste ulogovani!');

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request -> validate([
            'date' => 'required',
        ]);

        if (Auth::check()){
            $user = Auth::user();
        }
        else{
            return view('/')->with('danger', 'Niste ulogovani!');
        }

        $sparepartorder = new SparePartOrder([
            'date' => $request -> get('date'),
            'spare_part_id' => $request -> get('spare_part_id'),
            'user_id' => $user -> id,
            'position_id' => $request -> get('position_id'),
            'amount' => $request -> get('amount'),
            'note' => $request -> get('note'),
            'done' => 0,
        ]);

        $sparepartorder -> save();


        $position_id = $request -> get('position_id');

        return redirect('positions/'.$position_id)->with('message', 'Sačuvan podsjetnik za novu narudžbu');
    }

    public function edit($id)
    {
        //
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

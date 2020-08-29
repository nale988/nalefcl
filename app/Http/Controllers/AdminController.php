<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;


use DB;
use Carbon\Carbon;
use App\UserRole;
use App\WebsiteStatistic;

class AdminController extends Controller
{
    public function users(){
        if(Auth::check()){
            $user = Auth::user();
            $user_role = UserRole::where('id', $user -> id)->first();
            if($user_role -> admin){
                $users = User::
                    leftJoin('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->get([
                        'users.*',
                        'user_roles.admin as admin',
                        'user_roles.services as services',
                        'user_roles.workhours as workhours',
                        'user_roles.workorders as workorders',
                        'user_roles.lubrications as lubrications',
                        'user_roles.files as files',
                        'user_roles.private_items as private_items',
                        'user_roles.worktimes as worktimes',
                    ]);

                    // print_r(json_encode($users));
                    // die;
                return view('admin.users', compact('users'));
            }
        }
        return redirect()->back()->with('alert', 'Nemate pravo pristupa!');
    }

    public function permissions($id){
        if(Auth::check()){
            $user = Auth::user();
            $user_role = UserRole::where('id', $user -> id)->first();
            if($user_role -> admin){
                $selecteduser = User::where('id', $id)->first();
                $selectedrole = UserRole::where('user_id', $id)->first();
                return view('admin.permissions', compact('selecteduser', 'selectedrole'));
            }
        }
        return redirect()->back()->with('alert', 'Nemate pravo pristupa!');
    }

    public function update(Request $request, $id){
        $role = UserRole::where('id', $id)->first();

        $admin = ($request -> get('permission_admin') == 'on' ? 1 : 0);
        $services = ($request -> get('permission_services') == 'on' ? 1 : 0);
        $workhours = ($request -> get('permission_workhours') == 'on' ? 1 : 0);
        $workorders = ($request -> get('permission_workorders') == 'on' ? 1 : 0);
        $lubrications = ($request -> get('permission_lubrications') == 'on' ? 1 : 0);
        $files = ($request -> get('permission_files') == 'on' ? 1 : 0);
        $private = ($request -> get('permission_private') == 'on' ? 1 : 0);
        $worktimes = ($request -> get('permission_worktimes') == 'on' ? 1 : 0);

        $role -> admin = $admin;
        $role -> services = $services;
        $role -> workhours = $workhours;
        $role -> workorders = $workorders;
        $role -> lubrications = $lubrications;
        $role -> files = $files;
        $role -> private_items = $private;
        $role -> worktimes = $worktimes;

        $role -> save();
        return redirect()->back()->with('message', 'Izvršena izmjena!');
    }

    public function index(){
        if(Auth::check()){
            $user = Auth::user();
            $user_role = UserRole::where('id', $user -> id)->first();

            if($user_role -> admin){
                //$last_visits_all = WebsiteStatistic::orderByDesc('created_at')->get()->take(1000)->paginate(15);
                $last_visits = WebsiteStatistic::where('user_id', '<>', 1)->latest()->get()->paginate(15);
                $browsers = DB::table('website_statistics')
                    ->select('useragent', DB::raw('count(*) as total'))
                    ->where('user_id', '<>', 1)
                    ->groupBy('useragent')
                    ->get();
                $totalcountmobile = WebsiteStatistic::where('mobile', 1)->where('user_id', '<>', 1)->get()->count();
                $totalcount = WebsiteStatistic::where('user_id', '<>', 1)->get()->count();

                if($totalcount==0){
                    $totalcount=1;
                }

                if($totalcountmobile==0){
                    $totalcountmobile=1;
                }

                return view('admin.index', compact('last_visits', 'browsers', 'totalcountmobile', 'totalcount'));
            }
            else {
                return redirect()->back()->with('alert', 'Nemate pravo pristupa!');
            }
        }
    }

}

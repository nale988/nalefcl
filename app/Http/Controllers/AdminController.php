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
            $user_role = UserRole::where('user_id', $user -> id)->first();
            if($user_role -> admin){
                $users = User::
                    leftJoin('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->get([
                        'users.*',
                        'user_roles.admin as admin',
                        'user_roles.spare_parts_view as spare_parts_view',
                        'user_roles.spare_parts_add as spare_parts_add',
                        'user_roles.spare_parts_order as spare_parts_order',
                        'user_roles.revisions_view as revisions_view',
                        'user_roles.revisions_add as revisions_add',
                        'user_roles.services_view as services_view',
                        'user_roles.services_add as services_add',
                        'user_roles.workhours_view as workhours_view',
                        'user_roles.workhours_add as workhours_add',
                        'user_roles.workorders_view as workorders_view',
                        'user_roles.workorders_add as workorders_add',
                        'user_roles.lubrications_view as lubrications_view',
                        'user_roles.lubrications_add as lubrications_add',
                        'user_roles.files_view as files_view',
                        'user_roles.files_add as files_add',
                        'user_roles.private_items as private_items',
                        'user_roles.worktimes as worktimes',
                        'user_roles.todos as todos',
                        'user_roles.favorites as favorites'
                    ]);

                return view('admin.users', compact('users'));
            }
        }
        return redirect()->back()->with('alert', 'Nemate pravo pristupa!');
    }

    public function permissions($id){
        if(Auth::check()){
            $user = Auth::user();
            $user_role = UserRole::where('user_id', $user -> id)->first();
            if($user_role -> admin){
                $selecteduser = User::where('id', $id)->first();
                $selectedrole = UserRole::where('user_id', $id)->first();

                return view('admin.permissions', compact('selecteduser', 'selectedrole'));
            }
        }
        return redirect()->back()->with('alert', 'Nemate pravo pristupa!');
    }

    public function update(Request $request, $id){
        $admin = ($request -> get('permission_admin') == 'on' ? 1 : 0);

        $spare_parts_view = ($request -> get('permission_spare_parts_view') == 'on' ? 1 : 0);
        $spare_parts_add = ($request -> get('permission_spare_parts_add') == 'on' ? 1 : 0);
        $spare_parts_order = ($request -> get('permission_spare_parts_order') == 'on' ? 1 : 0);

        $services_view = ($request -> get('permission_services_view') == 'on' ? 1 : 0);
        $services_add = ($request -> get('permission_services_add') == 'on' ? 1 : 0);

        $revisions_view = ($request -> get('permission_revisions_view') == 'on' ? 1 : 0);
        $revisions_add = ($request -> get('permission_revisions_add') == 'on' ? 1 : 0);

        $workhours_view = ($request -> get('permission_workhours_view') == 'on' ? 1 : 0);
        $workhours_add = ($request -> get('permission_workhours_add') == 'on' ? 1 : 0);

        $workorders_view = ($request -> get('permission_workorders_view') == 'on' ? 1 : 0);
        $workorders_add = ($request -> get('permission_workorders_add') == 'on' ? 1 : 0);

        $lubrications_view = ($request -> get('permission_lubrications_view') == 'on' ? 1 : 0);
        $lubrications_add = ($request -> get('permission_lubrications_add') == 'on' ? 1 : 0);

        $files_view = ($request -> get('permission_files_view') == 'on' ? 1 : 0);
        $files_add = ($request -> get('permission_files_add') == 'on' ? 1 : 0);

        $private = ($request -> get('permission_private') == 'on' ? 1 : 0);
        $worktimes = ($request -> get('permission_worktimes') == 'on' ? 1 : 0);
        $todos = ($request -> get('permission_todos') == 'on' ? 1 : 0);
        $favorites = ($request -> get('permission_favorites') == 'on' ? 1 : 0);

        $role = UserRole::where('user_id', $id)->first();

        $role -> admin = $admin;

        $role -> spare_parts_view = $spare_parts_view;
        $role -> spare_parts_add = $spare_parts_add;
        $role -> spare_parts_order = $spare_parts_order;

        $role -> revisions_view = $revisions_view;
        $role -> revisions_add = $revisions_add;

        $role -> services_view = $services_view;
        $role -> services_add = $services_add;

        $role -> workhours_view = $workhours_view;
        $role -> workhours_add = $workhours_add;

        $role -> workorders_view = $workorders_view;
        $role -> workorders_add = $workorders_add;

        $role -> lubrications_view = $lubrications_view;
        $role -> lubrications_add = $lubrications_add;
        $role -> files_view = $files_view;
        $role -> files_add = $files_add;

        $role -> private_items = $private;
        $role -> worktimes = $worktimes;
        $role -> todos = $todos;
        $role -> favorites = $favorites;

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

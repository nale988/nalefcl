<?php

namespace App\Providers;

use Exception;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use App\ToDo;
use App\UserRole;
use App\Favorite;
use App\SparePartOrder;
use App\Unit;
use App\UserSetting;

use Carbon\Carbon;
use JsonException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'strana') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

            Schema::defaultStringLength(191);

            view()->composer('*', function ($view){
                if(Auth::check()){
                    $user = Auth::user();
                    $userrole = UserRole::where('user_id', $user -> id)->first();

                    $usersettings = UserSetting::where('user_id', $user -> id)->first();

                    $urgenttodos = ToDo::where('user_id', $user->id)
                        ->where('done', 0)
                        ->where('urgent', 1)
                        ->get()
                        ->sortBy('date');

                    $othertodos = ToDo::where('user_id', $user->id)
                        ->where('done', 0)
                        ->where('urgent', 0)
                        ->get()
                        ->sortBy('date');

                    $favorites = Favorite::leftJoin('positions', 'favorites.position_id', '=', 'positions.id')
                        ->where('user_id', $user -> id)
                        ->get()
                        ->sortBy('position');

                    $orders = SparePartOrder::where('user_id', $user -> id)
                        ->where('done', 0)
                        ->count();

                    $todoscount = ToDo::where('user_id', $user->id)
                        ->where('urgent', 1)
                        ->where('done', 0)
                        ->whereDate('date', '<=', Carbon::now())
                        ->count();

                    if($usersettings -> theme == 1){
                        $themecolor = 'primary';
                    } elseif($usersettings -> theme == 2){
                        $themecolor = 'secondary';
                    } elseif($usersettings -> theme == 3){
                        $themecolor = 'danger';
                    } else {
                        $themecolor = 'dark';
                    }

                }
                else {
                    $orders = 0;
                    $user = null;
                    $userrole = null;
                    $todoscount = 0;
                    $favorites = collect();
                    $urgents = collect();
                    $urgenttodos = collect();
                    $othertodos = collect();
                }

                $units = Unit::all()->sortBy('unit_number');

                $view->with([
                    'user' => $user,
                    'userrole' => $userrole,
                    'usersettings' => $usersettings,
                    'themecolor' => $themecolor,
                    'orders' => $orders,
                    'todoscount' => $todoscount,
                    'favorites' => $favorites,
                    'urgenttodos' => $urgenttodos,
                    'othertodos' => $othertodos,
                    'units' => $units]);
            });
    }
}

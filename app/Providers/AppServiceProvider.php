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
use App\Favorite;
use App\SparePartOrder;
use App\Unit;

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

                    // $urgents = ToDo::where('user_id', $user -> id)
                    //         ->where('done', 0)
                    //         ->get()
                    //         ->sortByDesc('urgent')
                    //         ->groupBy('urgent');

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
                }
                else {
                    $orders = 0;
                    $todoscount = 0;
                    $favorites = collect();
                    $urgents = collect();
                    $urgenttodos = collect();
                    $othertodos = collect();
                }

                $units = Unit::all()->sortBy('unit_number');
                // print_r(json_encode($units));
                // die;

                $view->with(['orders' => $orders, 'todoscount' => $todoscount, 'favorites' => $favorites, 'urgenttodos' => $urgenttodos, 'othertodos' => $othertodos, 'units' => $units]);
            });
    }
}

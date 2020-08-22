<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use App\ToDo;
use App\Favorite;
use App\SparePartOrder;
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

            // if(Auth::check()){
            //     $user = Auth::user();

            //     $urgents = ToDo::where('user_id', $user -> id)
            //             ->where('done', 0)
            //             ->get()
            //             ->sortByDesc('date');

            //     $favorites = Favorite::leftJoin('positions', 'favorites.position_id', '=', 'positions.id')
            //         ->where('user_id', $user -> id)
            //         ->get()
            //         ->sortBy('position');

            //     $orders = SparePartOrder::where('user_id', $user -> id)
            //         ->where('done', 0)
            //         ->count();

            //     $todoscount = ToDo::where('user_id', $user->id)
            //         ->where('urgent', 1)
            //         ->whereDate('date', '>=', Carbon::now())
            //         ->count();
            // }
            // else {
            //     $orders = 0;
            //     $todoscount = 0;
            //     $favorites = collect();
            //     $urgents = collect();
            // }

            view()->composer('*', function ($view){
                if(Auth::check()){
                    $user = Auth::user();

                    $urgents = ToDo::where('user_id', $user -> id)
                            ->where('done', 0)
                            ->get()
                            ->sortByDesc('urgent')
                            ->groupBy('urgent');

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
                }

                // print_r(json_encode($urgents));
                // die;

                $view->with(['orders' => $orders, 'todoscount' => $todoscount, 'favorites' => $favorites, 'urgents' => $urgents]);
            });
    }
}

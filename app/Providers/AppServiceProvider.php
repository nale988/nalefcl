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
use App\WebsiteStatistic;
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

                    // // user statistics
                    // if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                    //     $ip_proxy = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
                    //     $details = json_decode(file_get_contents("http://ipinfo.io/{$ip_proxy}/json?token=a18e93f1f5de2b"));
                    // } else {
                    //     $ip_proxy = null;
                    //     $details = null;
                    // }

                    // if(!is_null($details)){
                    //     $websitestatistic = new WebsiteStatistic([
                    //         'ip' => $_SERVER['REMOTE_ADDR'],
                    //         'ip_proxy' => $ip_proxy,
                    //         'useragent' => $_SERVER['HTTP_USER_AGENT'],
                    //         'page' => $_SERVER['REQUEST_URI'],
                    //         'city' => $details -> city,
                    //         'region' => $details -> region,
                    //         'loc' => $details -> loc,
                    //         'org' => $details -> org,
                    //         'user_id' => $user -> id
                    //     ]);
                    // }
                    // else {
                    //     $websitestatistic = new WebsiteStatistic([
                    //         'ip' => $_SERVER['REMOTE_ADDR'],
                    //         'ip_proxy' => $ip_proxy,
                    //         'useragent' => $_SERVER['HTTP_USER_AGENT'],
                    //         'page' => $_SERVER['REQUEST_URI'],
                    //         'user_id' => $user -> id
                    //     ]);
                    // }

                    // $websitestatistic -> save();
                }
                else {
                    $orders = 0;
                    $todoscount = 0;
                    $favorites = collect();
                    $urgents = collect();

                    // if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                    //     $ip_proxy = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
                    //     $details = json_decode(file_get_contents("http://ipinfo.io/{$ip_proxy}/json?token=a18e93f1f5de2b"));
                    // } else {
                    //     $ip_proxy = null;
                    //     $details = null;
                    // }

                    // if(!is_null($details)){
                    //     $websitestatistic = new WebsiteStatistic([
                    //         'ip' => $_SERVER['REMOTE_ADDR'],
                    //         'ip_proxy' => $ip_proxy,
                    //         'useragent' => $_SERVER['HTTP_USER_AGENT'],
                    //         'page' => $_SERVER['REQUEST_URI'],
                    //         'city' => $details -> city,
                    //         'region' => $details -> region,
                    //         'loc' => $details -> loc,
                    //         'org' => $details -> org,
                    //         'user_id' => 0
                    //     ]);
                    // }
                    // else {
                    //     $websitestatistic = new WebsiteStatistic([
                    //         'ip' => $_SERVER['REMOTE_ADDR'],
                    //         'ip_proxy' => $ip_proxy,
                    //         'useragent' => $_SERVER['HTTP_USER_AGENT'],
                    //         'page' => $_SERVER['REQUEST_URI'],
                    //         'user_id' => 0
                    //     ]);
                    // }

                    // $websitestatistic -> save();
                }

                $view->with(['orders' => $orders, 'todoscount' => $todoscount, 'favorites' => $favorites, 'urgents' => $urgents]);
            });
    }
}

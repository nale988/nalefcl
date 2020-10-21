<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\WebsiteStatistic;

class LogVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // user statistics
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip_proxy = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip_proxy}/json?token=a18e93f1f5de2b"));
        } else {
            $ip_proxy = null;
            $details = null;
        }

        //$ismobile = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        $ismobile = isset($_SERVER['HTTP_USER_AGENT']) && preg_match('!(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i', $_SERVER['HTTP_USER_AGENT']) ? 1 : 0;

        if(Auth::check()){
            $user = Auth::user();
                if(!is_null($details)){
                    $websitestatistic = new WebsiteStatistic([
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'ip_proxy' => $ip_proxy,
                        'useragent' => $_SERVER['HTTP_USER_AGENT'],
                        'mobile' => $ismobile,
                        'page' => $_SERVER['REQUEST_URI'],
                        'city' => $details -> city,
                        'region' => $details -> region,
                        'country' => $details -> country,
                        'loc' => $details -> loc,
                        //'org' => $details -> org,
                        'user_id' => $user -> id
                    ]);
                }
                else {
                    $websitestatistic = new WebsiteStatistic([
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'ip_proxy' => $ip_proxy,
                        'useragent' => $_SERVER['HTTP_USER_AGENT'],
                        'mobile' => $ismobile,
                        'page' => $_SERVER['REQUEST_URI'],
                        'user_id' => $user -> id
                    ]);
                }
            $websitestatistic -> save();
        }
        else {
            if(!is_null($details)){
                $websitestatistic = new WebsiteStatistic([
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'ip_proxy' => $ip_proxy,
                    'useragent' => $_SERVER['HTTP_USER_AGENT'],
                    'mobile' => $ismobile,
                    'page' => $_SERVER['REQUEST_URI'],
                    'city' => $details -> city,
                    'region' => $details -> region,
                    'country' => $details -> country,
                    'loc' => $details -> loc,
                    //'org' => $details -> org,
                    'user_id' => 0
                ]);
            }
            else {
                $websitestatistic = new WebsiteStatistic([
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'ip_proxy' => $ip_proxy,
                    'useragent' => $_SERVER['HTTP_USER_AGENT'],
                    'mobile' => $ismobile,
                    'page' => $_SERVER['REQUEST_URI'],
                    'user_id' => 0
                ]);
            }
        $websitestatistic -> save();
        }

        return $next($request);
    }
}

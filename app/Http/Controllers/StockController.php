<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    public function stock(){
        $response1 = Http::get('https://stock.shdhost.xyz/api/0001');
        $jsondata1 = json_decode($response1, true)['data'];
        $jad1 = implode(', ', $jsondata1);
        $response2 = Http::get('https://stock.shdhost.xyz/api/0002');
        $jsondata2 = json_decode($response2, true)['data'];
        $jad2 = implode(', ', $jsondata2);
        $response3 = Http::get('https://stock.shdhost.xyz/api/0003');
        $jsondata3 = json_decode($response3, true)['data'];
        $jad3 = implode(', ', $jsondata3);
        $response4 = Http::get('https://stock.shdhost.xyz/api/0004');
        $jsondata4 = json_decode($response4, true)['data'];
        $jad4 = implode(', ', $jsondata4);
        return view('stockdash')->with([
            'data1' => $jad1,
            'data2' => $jad2,
            'data3' => $jad3,
            'data4' => $jad4,
        ]);
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('variables')) {
                return redirect()->route('shop.index');
            }

            return $next($request);
        });
    }
    public function proceedSRM(Request $request)
    {
        $variables = Session::get('variables');
        $user = $variables['user'];
        $balance = $variables['balance'];
        $quantity= $variables['quantity'];
        $discord_id = $variables['discord_id'];
        $totalPrice = $variables['price'];
        $balance->decrement('amount', $totalPrice);
        $coins = $quantity * 50;
        $auth = config('scip.dashactyl.auth');
        $url = config('scip.dashactyl.url');
        $response = Http::withHeaders([
            'Accept' => 'application/json', 
            'Authorization' => $auth, 
        ])->post($url . '/api/addcoins', [
            'id' => $discord_id,
            'coins' => $coins,
        ]);
        $data = json_decode($response, true);
        $rescoins = $data['coins'];
        if ($data['status'] === 'success') {
            return redirect()->route('shop.index')->with('success', '成功購買！您花費了 ' . $totalPrice . ' $IPC 並且獲得了 ' . $coins . ' SRM 您現在共有 ' . $rescoins . ' SRM'); 
            Session::forget('variables');
        } else {
            $balance->increment('amount', $totalPrice);
            return redirect()->route('shop.index')->with('error', '發生未知錯誤 款項已退還');
            Session::forget('variables');
        }
    }
}

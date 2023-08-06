<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
class ShopController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', '請先登入帳號');
        }
        $products = Product::all();
        $user = Auth::user();
        $hasDiscordId = $user->discord_id !== null;

        return view('shop.index', compact('products', 'hasDiscordId'));
    }

    public function buyProduct(Request $request, Product $product)
    {
        
    
        if (auth()->user()->discord_id === null) {
            return redirect()->route('link_account')->with('info', '請先綁定 Discord 帳號'); 
        }
    
        
        $quantity = intval($request->input('quantity'));
        
        $user = auth()->user();
        $discord_id = $user->discord_id;
        $balance = $user->balance; 
    
        $totalPrice = $product->price * $quantity;
        if ($balance->amount < $totalPrice) {
            return redirect()->back()->with('error', '餘額不足，無法購買商品');
        }
        
        $variables = [
            'user' => $user,
            'balance' => $balance,
            'quantity' => $quantity,
            'discord_id' => $discord_id,
            'price' => $totalPrice,
        ];
        Session::put('variables', $variables);
        return redirect()->route('shop.proceed.srm');
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use App\Models\StockHolding;
use App\Models\StockPrice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    public function updateStockPrices()
    {
        $stocks = Stock::all();
        $stockPrices = [];

        foreach ($stocks as $stock) {
            $priceChange = mt_rand(-$stock->fluctuation, $stock->fluctuation) / 100;
            $stockId = $stock->id;
            $latestPrice = $this->getLatestStockPriceFromApi($stockId);
            if ($latestPrice) {
                if ($priceChange < 0 && $newPrice <= 0) {
                    return response()->json(['message' => 'Canceled'], 200);
                } else {
                $newPrice = $latestPrice + $priceChange;
                }
            } else {
                $newPrice = $stock->initial_price + $priceChange;
            }
            $stockPrice = new StockPrice([
                'stock_id' => $stock->id,
                'price' => $newPrice,
                'timestamp' => now(),
            ]);
            $stockPrice->save();

            

            $stockPrices[$stock->id] = StockPrice::where('stock_id', $stock->id)
                ->orderBy('timestamp', 'desc')
                ->limit(10)
                ->pluck('price')
                ->reverse()
                ->values()
                ->toArray();
            
            $oldStockPrices = StockPrice::where('stock_id', $stock->id)
                ->orderBy('timestamp', 'desc')
                ->skip(10) 
                ->take(PHP_INT_MAX) 
                ->get();
            
            foreach ($oldStockPrices as $oldStockPrice) {
                $oldStockPrice->delete();
            }
        }

        return response()->json($stockPrices);
    }

    public function getStockPrices()
    {
        $stocks = Stock::all();
        $stockPrices = [];
        foreach ($stocks as $stock) {
        $stockPrices[$stock->id] = StockPrice::where('stock_id', $stock->id)
                ->orderBy('timestamp', 'desc')
                ->limit(10)
                ->pluck('price')
                ->reverse()
                ->values()
                ->toArray();
        }
        return response()->json($stockPrices);
    }



    public function stockPage()
{
    $stocks = Stock::all();
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('info', '請先登入帳號');
    }

    if (!$user->discord_id) {
        return redirect()->route('link-account')->with('info', '請先綁定 Discord 帳號');
    }

    $userStocks = $user->stocks->all(); 
    $stockChartData = [];
    $apiKey = config('scip.apikey');

    foreach ($userStocks as $userStock) {
        $stockId = $userStock->id;
        $stockPrices = StockPrice::where('stock_id', $stockId)
            ->orderBy('timestamp', 'desc')
            ->limit(10)
            ->get()
            ->reverse()
            ->values()
            ->toArray();
        
        $stockChartData[$stockId] = $stockPrices;
    }

    return view('stock', [
        'user' => $user,
        'userStocks' => $userStocks,
        'stocks' => $stocks,
        'stockChartData' => $stockChartData,
        'apiKey' => $apiKey,
    ]);
}





public function buyStock(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('info', '請先登入帳號');
    }

    if (!$user->discord_id) {
        return redirect()->route('link-account')->with('info', '請先綁定 Discord 帳號');
    }

    $stockId = $request->input('stock_id');
    $quantity = $request->input('quantity');
    if ($quantity <= 0) {
        return redirect()->back()->with('error', '數量必須大於 0');
    }
    if ($quantity > 3) {
        return redirect()->back()->with('error', '股票每次最多只能購買 3 股');
    }
    $stock = Stock::findOrFail($stockId);

    
    $latestPrice = $this->getLatestStockPriceFromApi($stockId);

    $totalPrice = $latestPrice * $quantity;
    
    if ($user->balance->amount < $totalPrice) {
        return redirect()->back()->with('error', '餘額不足');
    }
    $balance = $user->balance;
    $balance->decrement('amount', $totalPrice);
    $stockHolding = $user->stocks()->where('stock_id', $stockId)->first();
    if (!$stockHolding) {
    
    $user->stocks()->updateOrCreate(['stock_id' => $stockId], ['quantity' => $quantity]);
} else {
    $user->stocks()->where('stock_id', $stockId)->increment('quantity', $quantity);
}

    
    $user->save();

    return redirect()->back()->with('success', '成功購買股票');
}




public function sellStock(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('info', '請先登入帳號');
    }
    if (!$user->discord_id) {
        return redirect()->route('link-account')->with('info', '請先綁定 Discord 帳號');
    }

    $stockHoldingId = $request->input('stock_holding_id');
    $quantity = $request->input('quantity');
    if ($quantity <= 0) {
        return redirect()->back()->with('error', '數量必須大於 0');
    }
    if ($quantity > 3) {
        return redirect()->back()->with('error', '股票每次最多只能出售 3 股');
    }
    $stockHolding = StockHolding::findOrFail($stockHoldingId);

    if ($stockHolding->quantity < $quantity) {
        return redirect()->back()->with('error', '股票數量不足');
    }

    $latestPrice = $this->getLatestStockPriceFromApi($stockHolding->stock_id);
    $lqPrice = $latestPrice * $quantity;
    $hsPrice = $lqPrice * 0.9;
    $totalPrice = $lqPrice - $hsPrice;
    $balance = $user->balance;
    $balance->increment('amount', $totalPrice);
    $stockHolding->decrement('quantity', $quantity);

    if ($stockHolding->quantity == 0) {
        $stockHolding->delete();
    }

    $user->save();

    return redirect()->back()->with('success', '成功售出股票');
}




    public function getLatestStockPriceFromApi($stockId)
{
    $stocks = Stock::all();
    $stockPrices = [];
    foreach ($stocks as $stock) {
    $stockPrices[$stock->id] = StockPrice::where('stock_id', $stock->id)
            ->orderBy('timestamp', 'desc')
            ->limit(10)
            ->pluck('price')
            ->reverse()
            ->values()
            ->toArray();
    }
    $pricesArray = $stockPrices[$stockId];
    $priceLatest = floatval(end($pricesArray));
    return $priceLatest;
}
}

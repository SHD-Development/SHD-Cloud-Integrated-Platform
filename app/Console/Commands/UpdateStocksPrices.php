<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stock;
use App\Models\StockPrice;
class UpdateStocksPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stock_prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update stock prices';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stocks = Stock::all();

        foreach ($stocks as $stock) {
            $fluctuation = $stock->fluctuation;
            $priceChange = mt_rand(-$fluctuation, $fluctuation) / 100;
            $newPrice = $stock->initial_price + $priceChange;


            $stockPrice = new StockPrice([
                'stock_id' => $stock->id,
                'price' => $newPrice,
                'timestamp' => now(),
            ]);
            $stockPrice->save();
        }

        $this->info('Stock prices updated successfully.');

    }
}

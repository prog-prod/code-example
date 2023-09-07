<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Log;

class RemoveProductSales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove-product-sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $now = Carbon::now();
        $products = Product::whereHas('sales', function ($q) use ($now) {
            $q->where('endDate', '>', $now);
        })->get();

        $counter = 0;
        foreach ($products as $product) {
            $sale = $product->sale;
            if ($now->gte($sale->endDate)) {
                Log::warning(
                    "Not Active Sale with endDate: [$sale->endDate] was deleted. DELETED SALE({$sale->toJson()})"
                );
                $sale->delete();
                $counter++;
            }
        }
        Log::alert("$counter not active sales were removed.");
    }
}

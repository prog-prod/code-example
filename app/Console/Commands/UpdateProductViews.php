<?php

namespace App\Console\Commands;

use App\Models\Product;
use DB;
use Illuminate\Console\Command;

class UpdateProductViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:product-views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the views column in the products table';


    public function handle()
    {
        $products = Product::all();
        $views = [];

        foreach ($products as $product) {
            if (visits($product)->count() != $product->views) {
                $views[$product->id] = visits($product)->count();
            }
        }
        if (count($views) > 0) {
            DB::table('products')
                ->whereIn('id', array_keys($views))
                ->update([
                    'views' => DB::raw(
                        'views + CASE id ' . implode(
                            ' ',
                            array_map(function ($id) use ($views) {
                                return "WHEN {$id} THEN {$views[$id]} ";
                            }, array_keys($views))
                        ) . ' END'
                    )
                ]);
        }
    }
}

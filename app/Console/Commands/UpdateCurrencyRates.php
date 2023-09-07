<?php

namespace App\Console\Commands;

use App\Facades\CurrencyFacade;
use Illuminate\Console\Command;

class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-currency-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update currency rates to cache';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        CurrencyFacade::getExchangeRate();
    }
}

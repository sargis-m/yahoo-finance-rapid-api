<?php

namespace App\Console\Commands;

use App\Services\StockService;
use Illuminate\Console\Command;

class FetchStockData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch stock data from external API';

    protected $stockService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StockService $stockService)
    {
        parent::__construct();

        $this->stockService = $stockService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->alert($this->description);

        $data = $this->stockService->fetchStockData();
        if ($data) {
            $this->stockService->processAndStoreStockData($data);

            $this->info('Stock data fetched and stored successfully.');
        } else {
            $this->info('Stock data not fetched');
        }

        return 0;
    }
}

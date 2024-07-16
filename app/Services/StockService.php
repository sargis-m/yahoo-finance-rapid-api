<?php

namespace App\Services;

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StockService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.rapidapi.key');
    }

    public function fetchStockData()
    {
        try {
            $response = Http::withHeaders([
                'X-RapidAPI-Host' => config('services.rapidapi.host'),
                'X-RapidAPI-Key' => $this->apiKey
            ])->get(config('services.rapidapi.base_url') . '/market/v2/get-summary', [
                'region' => 'US'
            ]);

            return $response->json();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function processAndStoreStockData($data)
    {
        foreach ($data['marketSummaryAndSparkResponse']['result'] as $item) {
            $symbol = $item['symbol'];
            $fullExchangeName = $item['fullExchangeName'];
            $latestClose = $item['spark']['close'] ? end($item['spark']['close']) : 0;
            $previousClose = $item['spark']['previousClose'];
            $priceChange = round($latestClose - $previousClose, 2);
            // Convert the Unix timestamp to a Carbon instance and format it to a datetime string
            $regularMarketTimeFormatted = Carbon::createFromTimestamp($item['regularMarketTime']['raw'])->toDateTimeString();

            Stock::create([
                    'symbol' => $symbol,
                    'full_exchange_name' => $fullExchangeName,
                    'latest_close' => $latestClose,
                    'previous_close' => $previousClose,
                    'price_change' => $priceChange,
                    'regular_market_time' => $regularMarketTimeFormatted,
            ]);
        }
    }
}

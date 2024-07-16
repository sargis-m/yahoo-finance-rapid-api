<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use App\Services\StockService;
use Illuminate\Support\Facades\Http;

class StockServiceTest extends TestCase
{
    /** @test */
    public function it_fetches_stock_data_successfully()
    {
        $mockResponse = [
            'marketSummaryResponse' => [
                'result' => [
                    [
                        "fullExchangeName" => "FTSE Index",
                        "exchangeTimezoneName" => "Europe/London",
                        "symbol" => "^FTSE",
                        "cryptoTradeable" => false,
                        "gmtOffSetMilliseconds" => 3600000,
                        "exchangeDataDelayedBy" => 15,
                        "firstTradeDateMilliseconds" => 441964800000,
                        "language" => "en-US",
                        "regularMarketTime" => [
                            "raw" => 1717077840,
                            "fmt" => "3:04PM BST",
                        ],
                        "exchangeTimezoneShortName" => "BST",
                        "quoteType" => "INDEX",
                        "hasPrePostMarketData" => false,
                        "customPriceAlertConfidence" => "NONE",
                        "marketState" => "REGULAR",
                        "market" => "gb_market",
                        "spark" => [
                            "dataGranularity" => 300,
                            "symbol" => "^FTSE",
                            "end" => 1717083000,
                            "previousClose" => 8183.07,
                            "chartPreviousClose" => 8183.07,
                            "start" => 1717052400,
                            "close" => [8185.07, 8188.08]
                        ]
                    ]
                ]
            ]
        ];

        Http::fake([
            config('services.rapidapi.base_url') . '/market/v2/get-summary/region=US' => Http::response($mockResponse)
        ]);

        $stockService = new StockService();
        $result = $stockService->fetchStockData();

        $this->assertNotNull($result);
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StockTable extends Component
{
    use WithPagination;

    public function render()
    {
        $subQuery = Stock::query()
            ->select('symbol', DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('symbol');

        $stocks = Stock::query()
            ->joinSub($subQuery, 'latest', function ($join) {
                $join->on('stocks.symbol', '=', 'latest.symbol')
                    ->on('stocks.created_at', '=', 'latest.latest_created_at');
            })
            ->select('stocks.symbol', 'stocks.full_exchange_name', 'stocks.latest_close', 'stocks.previous_close', 'stocks.price_change', 'stocks.regular_market_time')
            ->orderBy('stocks.regular_market_time', 'desc')
            ->paginate(10);

        return view('livewire.stock-table', compact('stocks'));
    }

    // TODO: to refresh data periodically in UI table I used Livewire wire:poll, but instead of it we also could implement it using websockets
}


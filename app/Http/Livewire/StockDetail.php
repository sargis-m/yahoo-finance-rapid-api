<?php

// app/Http/Livewire/StockDetail.php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;

class StockDetail extends Component
{
    public $stock;
    public $historicalData;

    public function mount($symbol)
    {
        $this->stock = Stock::where('symbol', $symbol)
            ->orderBy('created_at', 'desc')
            ->firstOrFail();

        $this->historicalData = $this->stock->getHistoricalData();
    }

    public function render()
    {
        return view('livewire.stock-detail');
    }
}


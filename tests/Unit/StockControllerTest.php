<?php

namespace Tests\Unit;

use App\Http\Livewire\StockDetail;
use App\Http\Livewire\StockTable;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockControllerTest extends TestCase
{
    /** @test */
    use RefreshDatabase;

    /** @test */
    public function it_retrieves_all_stocks()
    {
        $response = $this->get(route('stocks.index'));
        $response
            ->assertSuccessful()
            ->assertSee('Stock Market Data');

        Livewire::test(StockTable::class)
            ->assertSuccessful();
    }

    /** @test */
    public function it_retrieves_a_specific_stock()
    {
        $stock = Stock::factory()->create();

        $response = $this->get(route('stocks.show', ['symbol' => $stock->symbol]));
        $response
            ->assertSuccessful()
            ->assertSee(['Stock Details', $stock->symbol]);

        Livewire::test(StockDetail::class, ['symbol' => $stock->symbol])
            ->assertSuccessful();
    }
}

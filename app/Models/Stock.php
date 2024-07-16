<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'symbol',
        'full_exchange_name',
        'latest_close',
        'previous_close',
        'price_change',
        'regular_market_time',
    ];

    public function getPercentChangeAttribute(): string
    {
        return number_format(($this->price_change / $this->previous_close) * 100, 2);
    }

    public function getHistoricalData()
    {
        $data = DB::table('stocks')
            ->where('symbol', $this->symbol)
            ->select('latest_close', 'regular_market_time')
            ->get();

        return [
            'dates' => $data->pluck('regular_market_time')->toArray(),
            'prices' => $data->pluck('latest_close')->toArray(),
        ];
    }
}

<div wire:poll.55s>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <tr>
                <th class="py-3 px-6 text-left">Symbol</th>
                <th class="py-3 px-6 text-left">Exchange Name</th>
                <th class="py-3 px-6 text-left">Latest Close</th>
                <th class="py-3 px-6 text-left">Previous Close</th>
                <th class="py-3 px-6 text-left">Price Change</th>
                <th class="py-3 px-6 text-left">Action</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            @foreach ($stocks as $stock)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $stock->symbol }}</td>
                    <td class="py-3 px-6 text-left">{{ $stock->full_exchange_name }}</td>
                    <td class="py-3 px-6 text-left">{{ number_format($stock->latest_close, 2) }}</td>
                    <td class="py-3 px-6 text-left">{{ number_format($stock->previous_close, 2) }}</td>
                    <td class="py-3 px-6 text-left {{ $stock->price_change > 0 ? 'text-green-500' : 'text-red-500' }}">
                        {{ $stock->price_change > 0 ? '+' : '' }}{{ number_format($stock->price_change, 2) }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        <a href="/stocks/{{$stock->symbol}}" class="text-blue-500">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $stocks->links() }}
    </div>
</div>

{{--<script>--}}
{{--    Livewire.on('refreshStocks', function () {--}}
{{--    @this.call('fetchStocks');--}}
{{--    });--}}
{{--</script>--}}


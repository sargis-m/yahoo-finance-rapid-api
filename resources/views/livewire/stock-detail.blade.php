<div class="container mx-auto px-4">
    <div class="bg-gray-100 flex items-start justify-center">
        <div class="bg-white rounded-3xl border border-black shadow-md px-5 pt-3 pb-7 text-left max-w-full mt-6">
            <div class="text-sm text-black-500 font-medium">{{ $stock->symbol }}</div>
            <div class="text-sm text-gray-500">{{ $stock->full_exchange_name }}</div>
            <div class="mt-2 text-3xl font-bold text-gray-900 flex">
                <span class="mr-2">{{ number_format($stock->latest_close, 2) }}</span>
                <div
                    class="mt-1 text-xl font-medium {{ $stock->price_change >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    @php
                        $sign = $stock->price_change > 0 ? '+' : '';
                    @endphp
                    {{ $sign . number_format($stock->price_change, 2) }}
                    {{ '(' . $sign . $stock->percent_change . '%)' }}
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <canvas id="stockChart" height="200" width="400"></canvas>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('stockChart').getContext('2d');
            var stockChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($historicalData['dates']),
                    datasets: [{
                        label: 'Price',
                        data: @json($historicalData['prices']),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });
        });
    </script>
@endpush


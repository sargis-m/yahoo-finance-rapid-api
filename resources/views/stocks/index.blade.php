@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-center text-2xl font-bold my-4">Stock Market Data</h1>
        @livewire('stock-table')
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        return view('stocks.index');
    }

    public function show($symbol)
    {
        return view('stocks.show', compact('symbol'));
    }
}

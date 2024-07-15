<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalSales = ProductTransaction::where('is_paid', true)->sum('total_amount');
        $totalOrders = ProductTransaction::count();
        $totalProducts = Product::count();
        $recentProducts = Product::orderBy('created_at', 'desc')->take(5)->get();
        $recentOrders = ProductTransaction::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact('totalSales', 'totalOrders', 'totalProducts', 'recentProducts', 'recentOrders'));
    }
}

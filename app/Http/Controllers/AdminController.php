<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Calculate total revenue from completed orders
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        // Get active orders count (pending, processing, shipped)
        $activeOrders = Order::whereIn('status', ['pending', 'processing', 'shipped'])->count();

        // Get total customers count (temporary: counting all users until role column is added)
        $totalCustomers = User::count();

        // Get low stock items (stock < 10)
        $lowStockItems = Product::where('stock', '<', 10)->count();

        // Get recent orders with customer and product details
        $recentOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(5)
            ->get();

        // Calculate revenue growth (comparing this month to last month)
        $currentMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $lastMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_amount');

        $revenueGrowth = $lastMonthRevenue > 0
            ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 0;

        // Calculate orders growth
        $currentMonthOrders = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $ordersGrowth = $lastMonthOrders > 0
            ? (($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100
            : 0;

        // Calculate customers growth (temporary: using all users)
        $currentMonthCustomers = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonthCustomers = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $customersGrowth = $lastMonthCustomers > 0
            ? (($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100
            : 0;

        // Revenue target (example: $30,000)
        $revenueTarget = 30000;
        $revenueProgress = $revenueTarget > 0 ? ($totalRevenue / $revenueTarget) * 100 : 0;

        return view('admin.dashboard', compact(
            'totalRevenue',
            'activeOrders',
            'totalCustomers',
            'lowStockItems',
            'recentOrders',
            'revenueGrowth',
            'ordersGrowth',
            'customersGrowth',
            'revenueTarget',
            'revenueProgress'
        ));
    }
}

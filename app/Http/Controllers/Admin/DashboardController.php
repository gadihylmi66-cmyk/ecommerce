<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function dashboard()
    {
        $stats = [
            'users' => \App\Models\User::count(),
            'products' => \App\Models\Product::count(),
            'orders' => \App\Models\Order::count(),
            'total_orders' => \App\Models\Order::count(),
            'total_products' => \App\Models\Product::count(),
            'total_customers' => \App\Models\User::where('role', 'customer')->count(),
            'total_revenue' => \App\Models\Order::where('payment_status', ['processing','completed'])->sum('total_amount'),
            'pending_orders' => \App\Models\Order::where('status', 'pending')->where('payment_status', 'paid')->count(),
            'low_stock' => \App\Models\Product::where('stock', '<', 10)->count(),
        ];
        $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();

        $topProducts = Product::withCount(['orderItems as sold' => function ($q) {
                // Kita hanya hitung item yang berasal dari order yang SUDAH DIBAYAR (paid)
                $q->select(DB::raw('SUM(quantity)'))
                  ->whereHas('order', function($query) {
                      $query->where('payment_status', 'paid');
                  });
            }])
            ->having('sold', '>', 0) // Filter: Hanya tampilkan yang pernah terjual
            ->orderByDesc('sold')    // Urutkan dari yang paling laku
            ->take(5)
            ->get();

        // 4. Data Grafik Pendapatan (7 Hari Terakhir)
        // Kasus: Grouping data per tanggal
        // Kita gunakan DB::raw untuk format tanggal dari timestamp 'created_at'
        $revenueChart = Order::select([
                DB::raw('DATE(created_at) as date'), // Ambil tanggalnya saja (2024-12-10)
                DB::raw('SUM(total_amount) as total') // Total omset hari itu
            ])
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subDays(7)) // Filter 7 hari ke belakang
            ->groupBy('date') // Kelompokkan baris berdasarkan tanggal
            ->orderBy('date', 'asc') // Urutkan kronologis
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts', 'revenueChart'));
    }
}

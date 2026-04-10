<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            $dashboardData = [
                'totalUsers' => User::count(),
                'totalProducts' => Product::count(),
                'totalOrders' => Order::count(),
                'totalRevenue' => Order::sum('total_price'),
            ];
        } else {
            $dashboardData = [
                'totalProducts' => Product::count(),
                'todayOrders' => Order::whereDate('sale_date', now())->count(),
                'todayRevenue' => Order::whereDate('sale_date', now())->sum('total_price'),
            ];
        }

        return view('dashboard.index', compact('role', 'dashboardData'));
    }
}

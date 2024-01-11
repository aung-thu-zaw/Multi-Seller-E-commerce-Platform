<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Inertia\ResponseFactory;

class DashboardController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        $thisMonthStart = Carbon::now()->startOfMonth();
        $thisMonthEnd = Carbon::now()->endOfMonth();
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        $currentYear = Carbon::now()->format("Y");
        $lastYear = Carbon::now()->subYear()->format("Y");

        $totalUsers = User::count();
        $lastMonthUserCount = User::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $thisMonthUserCount = User::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count();
        $userCountDifference = $thisMonthUserCount - $lastMonthUserCount;
        $percentageChangeUsers = $lastMonthUserCount ? ($userCountDifference / $lastMonthUserCount) * 100 : 0;
        $percentageChangeUsers = round(max(min($percentageChangeUsers, 100), -100), 2);

        $totalOrders = Order::count();
        $lastMonthOrderCount = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $thisMonthOrderCount = Order::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count();
        $orderCountDifference = $thisMonthOrderCount - $lastMonthOrderCount;
        $percentageChangeOrders = $lastMonthOrderCount ? ($orderCountDifference / $lastMonthOrderCount) * 100 : 0;
        $percentageChangeOrders = round(max(min($percentageChangeOrders, 100), -100), 2);

        $totalSales = Order::sum('total_amount');
        $lastMonthSales = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('total_amount');
        $thisMonthSales = Order::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->sum('total_amount');
        $totalSalesDifference = $thisMonthSales - $lastMonthSales;
        $percentageChangeSales = $lastMonthSales ? ($totalSalesDifference / $lastMonthSales) * 100 : 0;
        $percentageChangeSales = round(max(min($percentageChangeSales, 100), -100), 2);

        $yesterdayEarnings = Order::whereDate('created_at', $yesterday)->sum('total_amount');
        $todayEarnings = Order::whereDate('created_at', $today)->sum('total_amount');
        $salesDifference = $todayEarnings - $yesterdayEarnings;
        $percentageChangeTodayEarnings = $yesterdayEarnings ? ($salesDifference / $yesterdayEarnings) * 100 : 0;
        $percentageChangeTodayEarnings = round(max(min($percentageChangeTodayEarnings, 100), -100), 2);

        $thisYearMonthlyOrder = Order::selectRaw('MONTH(created_at) as month,COUNT(*) as total_orders')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();
        $thisYearMonthlyOrderLabels = $thisYearMonthlyOrder->pluck('month');
        $thisYearMonthlyOrderData = $thisYearMonthlyOrder->pluck('total_orders');

        $lastYearMonthlyOrder = Order::selectRaw('MONTH(created_at) as month,COUNT(*) as total_orders')
                    ->whereYear('created_at', $lastYear)
                    ->groupBy('month')
                    ->orderBy('month', 'asc')
                    ->get();
        $lastYearMonthlyOrderLabels = $lastYearMonthlyOrder->pluck('month');
        $lastYearMonthlyOrderData = $lastYearMonthlyOrder->pluck('total_orders');

        $thisYearMonthlyUser = User::selectRaw('MONTH(created_at) as month,COUNT(*) as total_users')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();
        $thisYearMonthlyUserLabels = $thisYearMonthlyUser->pluck('month');
        $thisYearMonthlyUserData = $thisYearMonthlyUser->pluck('total_users');

        $lastYearMonthlyUser = User::selectRaw('MONTH(created_at) as month,COUNT(*) as total_users')
                    ->whereYear('created_at', $lastYear)
                    ->groupBy('month')
                    ->orderBy('month', 'asc')
                    ->get();
        $lastYearMonthlyUserLabels = $lastYearMonthlyUser->pluck('month');
        $lastYearMonthlyUserData = $lastYearMonthlyUser->pluck('total_users');

        $thisYearMonthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_amount')
        ->groupBy('month')
        ->whereYear("created_at", $currentYear)
        ->orderBy("month", "asc")
        ->get();
        $thisYearMonthlySaleLabels = $thisYearMonthlySales->pluck('month');
        $thisYearMonthlySaleData = $thisYearMonthlySales->pluck('total_amount');

        $lastYearMonthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_amount')
                ->groupBy('month')
                ->whereYear("created_at", $lastYear)
                ->orderBy("month", "asc")
                ->get();
        $lastYearMonthlySaleLabels = $lastYearMonthlySales->pluck('month');
        $lastYearMonthlySaleData = $lastYearMonthlySales->pluck('total_amount');

        return inertia('Admin/Dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalSales',
            'todayEarnings',
            'percentageChangeUsers',
            'percentageChangeOrders',
            'percentageChangeSales',
            'percentageChangeTodayEarnings',
            'thisYearMonthlyOrderLabels',
            'thisYearMonthlyOrderData',
            'lastYearMonthlyOrderLabels',
            'lastYearMonthlyOrderData',
            'thisYearMonthlyUserLabels',
            'thisYearMonthlyUserData',
            'lastYearMonthlyUserLabels',
            'lastYearMonthlyUserData',
            'thisYearMonthlySaleLabels',
            'thisYearMonthlySaleData',
            'lastYearMonthlySaleLabels',
            'lastYearMonthlySaleData'
        ));
    }
}

<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Inertia\Response;
use Inertia\ResponseFactory;

class DashboardController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        $store = Store::with(['followers:id'])->where("seller_id", auth()->id())->first();

        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        $thisMonthStart = Carbon::now()->startOfMonth();
        $thisMonthEnd = Carbon::now()->endOfMonth();
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        $currentYear = Carbon::now()->format("Y");
        $lastYear = Carbon::now()->subYear()->format("Y");

        $totalFollowers = $store->followers->count();
        $lastMonthFollowerCount = $store->followers->where('pivot.accepted_at', '>=', $lastMonthStart)->where('pivot.accepted_at', '<=', $lastMonthEnd)->count();
        $thisMonthFollowerCount = $store->followers->where('pivot.accepted_at', '>=', $thisMonthStart)->where('pivot.accepted_at', '<=', $thisMonthEnd)->count();
        $followerCountDifference = $thisMonthFollowerCount - $lastMonthFollowerCount;
        $percentageChangeFollowers = $lastMonthFollowerCount ? ($followerCountDifference / $lastMonthFollowerCount) * 100 : 0;
        $percentageChangeFollowers = round(max(min($percentageChangeFollowers, 100), -100), 2);

        $totalOrders = OrderItem::where("store_id", $store->id)->count();
        $lastMonthOrderCount = OrderItem::where("store_id", $store->id)->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $thisMonthOrderCount = OrderItem::where("store_id", $store->id)->whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count();
        $orderCountDifference = $thisMonthOrderCount - $lastMonthOrderCount;
        $percentageChangeOrders = $lastMonthOrderCount ? ($orderCountDifference / $lastMonthOrderCount) * 100 : 0;
        $percentageChangeOrders = round(max(min($percentageChangeOrders, 100), -100), 2);

        $totalSales = OrderItem::where("store_id", $store->id)->sum('total_price');
        $lastMonthSales = OrderItem::where("store_id", $store->id)->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('total_price');
        $thisMonthSales = OrderItem::where("store_id", $store->id)->whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->sum('total_price');
        $totalSalesDifference = $thisMonthSales - $lastMonthSales;
        $percentageChangeSales = $lastMonthSales ? ($totalSalesDifference / $lastMonthSales) * 100 : 0;
        $percentageChangeSales = round(max(min($percentageChangeSales, 100), -100), 2);

        $yesterdayEarnings = OrderItem::where("store_id", $store->id)->whereDate('created_at', $yesterday)->sum('total_price');
        $todayEarnings = OrderItem::where("store_id", $store->id)->whereDate('created_at', $today)->sum('total_price');
        $salesDifference = $todayEarnings - $yesterdayEarnings;
        $percentageChangeTodayEarnings = $yesterdayEarnings ? ($salesDifference / $yesterdayEarnings) * 100 : 0;
        $percentageChangeTodayEarnings = round(max(min($percentageChangeTodayEarnings, 100), -100), 2);


        $thisYearMonthlyOrder = OrderItem::selectRaw('MONTH(order_items.created_at) as month, COUNT(*) as total_orders')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->whereYear('order_items.created_at', $currentYear)
        ->where("store_id", $store->id)
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        $thisYearMonthlyOrderLabels = $thisYearMonthlyOrder->pluck('month');
        $thisYearMonthlyOrderData = $thisYearMonthlyOrder->pluck('total_orders');

        $lastYearMonthlyOrder = OrderItem::selectRaw('MONTH(order_items.created_at) as month, COUNT(*) as total_orders')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereYear('order_items.created_at', $lastYear)
            ->where("store_id", $store->id)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $lastYearMonthlyOrderLabels = $lastYearMonthlyOrder->pluck('month');
        $lastYearMonthlyOrderData = $lastYearMonthlyOrder->pluck('total_orders');

        $thisYearMonthlySales = OrderItem::selectRaw('MONTH(order_items.created_at) as month, SUM(order_items.total_price) as total_amount')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->groupBy('month')
        ->whereYear('order_items.created_at', $currentYear)
        ->where("store_id", $store->id)
        ->orderBy('month', 'asc')
        ->get();

        $thisYearMonthlySaleLabels = $thisYearMonthlySales->pluck('month');
        $thisYearMonthlySaleData = $thisYearMonthlySales->pluck('total_amount');

        $lastYearMonthlySales = OrderItem::selectRaw('MONTH(order_items.created_at) as month, SUM(order_items.total_price) as total_amount')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->groupBy('month')
            ->whereYear('order_items.created_at', $lastYear)
            ->where("store_id", $store->id)
            ->orderBy('month', 'asc')
            ->get();

        $lastYearMonthlySaleLabels = $lastYearMonthlySales->pluck('month');
        $lastYearMonthlySaleData = $lastYearMonthlySales->pluck('total_amount');


        return inertia('Seller/Dashboard', compact(
            'store',
            'totalFollowers',
            'totalOrders',
            'totalSales',
            'todayEarnings',
            'percentageChangeFollowers',
            'percentageChangeOrders',
            'percentageChangeSales',
            'percentageChangeTodayEarnings',
            'thisYearMonthlyOrderLabels',
            'thisYearMonthlyOrderData',
            'lastYearMonthlyOrderLabels',
            'lastYearMonthlyOrderData',
            'thisYearMonthlySaleLabels',
            'thisYearMonthlySaleData',
            'lastYearMonthlySaleLabels',
            'lastYearMonthlySaleData'
        ));
    }
}

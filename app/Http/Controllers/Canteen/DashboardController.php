<?php

namespace App\Http\Controllers\Canteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $canteen = Auth::user()->canteen;

    if (! $canteen) {
        // No linked canteen: show zeros and empty list
        return view('canteen.dashboard', [
            'pendingOrdersCount'   => 0,
            'todayOrdersCount'     => 0,
            'todayRevenue'         => 0,
            'activeMenuItemsCount' => 0,
            'latestOrders'         => collect(),
        ]);
    }

    $baseQuery = Order::where('canteen_id', $canteen->id);

    $pendingOrdersCount = (clone $baseQuery)
        ->where('status', 'pending')
        ->count();

    $todayOrdersCount = (clone $baseQuery)
        ->whereDate('created_at', today())
        ->count();

    $todayRevenue = (clone $baseQuery)
        ->where('status', 'completed')
        ->whereDate('created_at', today())
        ->sum('total_amount');

    $activeMenuItemsCount = $canteen->menus()->count();

    $latestOrders = $baseQuery
        ->with('user')
        ->latest()
        ->take(5)
        ->get();

    return view('canteen.dashboard', compact(
        'pendingOrdersCount',
        'todayOrdersCount',
        'todayRevenue',
        'activeMenuItemsCount',
        'latestOrders'
    ));
    }
}

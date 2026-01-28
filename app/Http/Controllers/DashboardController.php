<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canteen;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            $canteensCount  = Canteen::count();
            $ordersCount    = Order::where('user_id', $user->id)->count();
            $favoritesCount = method_exists($user, 'favouriteCanteens')
                ? $user->favouriteCanteens()->count(): 0;

            return view('dashboard.student', compact(
            'canteensCount',
            'ordersCount',
            'favoritesCount'
            ));
        }

        if ($user->role === 'canteen') {
            return redirect()->route('canteen.orders.index');
        }

        // Admin (or any other role) => show admin dashboard view with stats
        $canteensCount    = Canteen::count();
        $ordersCount      = Order::count();
        $usersCount       = User::count();
        $todayOrdersCount = Order::whereDate('created_at', today())->count(); // Carbon today()

        return view('dashboard.admin', compact(
            'canteensCount',
            'ordersCount',
            'usersCount',
            'todayOrdersCount'
        ));
    }
}


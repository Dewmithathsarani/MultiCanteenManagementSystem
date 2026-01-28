<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'canteen'])->latest();

        // Optional date filter from query string
        if ($request->get('date') === 'today') {
            $query->whereDate('created_at', today());
        }

        $orders = $query->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // List current student's orders
    public function index(Request $request)
    {
        $query = auth()->user()->orders()->with('canteen', 'items.menu');
       // $orders = Order::with('canteen', 'items.menu')
            // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range (simple examples)
        if ($request->filled('date') && $request->date === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($request->filled('date') && $request->date === 'last7') {
            $query->whereDate('created_at', '>=', now()->subDays(7));
        } elseif ($request->filled('date') && $request->date === 'month') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        }

        $orders = $query->latest()->paginate(10);

        return view('student.orders.index', compact('orders'));
    }

    // Place an order for one menu item (quantity 1)
    public function store(Request $request, Menu $menu)
    {
        
    $request->validate([
        'quantity' => 'required|integer|min:1',
        'payment_method'  => 'required|in:cash_on_delivery,online',
    ]);

    $quantity = (int) $request->input('quantity');
    $paymentMethod  = $request->input('payment_method');

        $order = Order::create([
        'user_id'      => Auth::id(),
        'canteen_id'   => $menu->canteen_id,
        'total_amount' => $menu->price * $quantity,
        'status'       => 'pending',
        'payment_method' => $paymentMethod,
        'payment_status' => $paymentMethod === 'cash_on_delivery' ? 'unpaid' : 'pending',
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'menu_id'  => $menu->id,
        'quantity' => $quantity,
        'price'    => $menu->price,
    ]);

    return redirect()
        ->route('student.orders.index')
        ->with('success', 'Order placed successfully.');
    }

    public function cancel(Order $order)
    {
        // Ensure this order belongs to the logged-in student
        if ($order->user_id !== Auth::id()) {
            abort(403);
    }

    // Only allow cancel when pending
    if ($order->status !== 'pending') {
        return redirect()
            ->route('student.orders.index')
            ->with('error', 'Only pending orders can be cancelled.');
    }

    $order->status = 'cancelled';
    $order->save();

    return redirect()
        ->route('student.orders.index')
        ->with('success', 'Order cancelled successfully.');
    }

}

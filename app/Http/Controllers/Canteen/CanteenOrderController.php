<?php

namespace App\Http\Controllers\Canteen;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusUpdated;

class CanteenOrderController extends Controller
{
    public function index(Request $request)
    {
        $canteen = Auth::user()->canteen; // or however you get the canteen

        if (! $canteen) {
            abort(403, 'No canteen assigned to this user.');
        }

        $ordersQuery = $canteen->orders()
            ->with(['orderItems.menu', 'user'])
            ->latest();

        if ($request->filled('status')) {
            $ordersQuery->where('status', $request->status);
        }

        $orders = $ordersQuery->paginate(10)->withQueryString();

        return view('canteen.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Optional: validate allowed statuses
        $request->validate([
            'status' => 'required|in:pending,accepted,completed,cancelled',
        ]);

        // This order already belongs to this canteen via route/middleware; 
        // if you want, add an extra safety check:
        if ($order->canteen_id !== auth()->user()->canteen->id) {
            abort(403);
        }

        $oldStatus = $order->status;
        $newStatus = $request->status;

        if ($oldStatus !== $newStatus) {
            $order->user->notify(new OrderStatusUpdated($order, $oldStatus, $newStatus));
        }

        $order->status = $newStatus;
        $order->save();

        if ($newStatus === 'completed' && $order->payment_method === 'cash_on_delivery') {
            $order->payment_status = 'paid';
            $order->save();
        }


        return redirect()
            ->route('canteen.orders.index')
            ->with('success', 'Order status updated.');
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        // Only allow this canteen to touch its orders
        if ($order->canteen_id !== auth()->user()->canteen->id) {
            abort(403);
        }

        $request->validate([
            'payment_status' => 'required|in:paid,unpaid',
        ]);

        $order->payment_status = $request->payment_status;
        $order->save();

        return redirect()
            ->back()
            ->with('success', 'Payment status updated.');
    }


}

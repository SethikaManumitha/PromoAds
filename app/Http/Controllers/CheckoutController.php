<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Driver;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showForm()
    {
        $drivers = Driver::all();
        return view('checkout', compact('drivers'));
    }

    public function showOrders()
    {
        $orders = Order::where('shop_id', session('business_id'))
            ->where('business_status', '!=', 'canceled')
            ->where('driver_status', '!=', 'delivered')
            ->get();

        $orderIds = $orders->pluck('id');

        $items = OrderItem::whereIn('order_id', $orderIds)
            ->with('product')
            ->get();

        return view('manageOrders', compact('orders', 'items'));
    }




    public function cancelOrder(Order $order)
    {
        // Ensure the order is not already completed
        if ($order->business_status !== 'completed') {
            $order->business_status = 'canceled';
            $order->save();
        }

        return redirect()->route('orders')->with('status', 'Order canceled successfully.');
    }

    public function prepareOrder(Order $order)
    {
        if ($order->business_status !== 'completed' && $order->business_status !== 'canceled') {
            $order->business_status = 'accepted';
            $order->save();
        }

        return redirect()->route('orders')->with('status', 'Order is being prepared.');
    }

    public function processOrder(Order $order)
    {
        if ($order->business_status !== 'done' && $order->business_status !== 'canceled') {
            $order->business_status = 'done';
            $order->save();
        }

        return redirect()->route('orders')->with('status', 'Order is being prepared.');
    }


    public function acceptOrder(Order $order)
    {
        if ($order->business_status !== 'completed' && $order->business_status !== 'canceled') {
            $order->driver_status = 'accepted';
            $order->save();
        }

        return redirect()->route('orders.driver')->with('status', 'Order accepted by driver.');
    }

    public function cancelDriverOrder(Order $order)
    {
        if ($order->driver_status === 'accepted') {
            $order->driver_status = 'canceled';
            $order->save();
        }

        return redirect()->route('orders.driver')->with('status', 'Order is in progress.');
    }

    public function deliveredOrder(Order $order)
    {
        if ($order->driver_status === 'accepted') {
            $order->driver_status = 'delivered';
            $order->save();
        }
        return redirect()->route('orders.driver')->with('status', 'Order delivered.');
    }


    public function showOrdersDriver()
    {
        $orders = Order::where('driver_id', session('nic'))
            ->where('business_status', 'done')
            ->whereIn('driver_status', ['pending', 'accepted'])
            ->get();

        $orderIds = $orders->pluck('id');

        $items = OrderItem::whereIn('order_id', $orderIds)
            ->with('product')
            ->get();

        return view('manageOrdersDriver', compact('orders', 'items'));
    }


    public function checkoutSubmit(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'fullName' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|numeric',
            'driver_id' => 'required|exists:drivers,NIC',
            'payment_method' => 'required|in:cod,card',
            'total' => 'required|min:0',
        ]);

        $cartItems = [];

        if (Auth::check()) {
            // For authenticated users
            $cartItems = Cart::where('user_id', Auth::id())->with('promotion')->get();
        } else {
            // For guest users
            $cart = session()->get('cart', []);

            foreach ($cart as $productId => $item) {
                $promotion = Promotion::find($productId);

                if ($promotion) {
                    $item['promotion'] = $promotion;
                    $cartItems[] = $item;
                }
            }
        }


        foreach ($cartItems as $cartItem) {
            if ($cartItem['promotion']) {
                $shop_id = $cartItem['promotion']->business_id;
            }
        }

        // Create a new order
        $order = Order::create([
            'fullname' => $validated['fullName'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'phone' => $validated['phone'],
            'total' => $validated['total'],
            'payment_method' => $validated['payment_method'],
            'driver_id' => $validated['driver_id'],
            'shop_id' => $shop_id
        ]);


        foreach ($cartItems as $cartItem) {
            if ($cartItem['promotion']) {
                // Create OrderItem for each cart item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem['promotion']->id,
                    'quantity' => $cartItem['quantity'] ?? 1,
                ]);
            }
        }

        return redirect()->route('orderSuccess');
    }
}

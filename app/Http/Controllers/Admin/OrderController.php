<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }

    public function voucher($id)
    {
        $order = Order::with('user')->findOrFail($id);
        $products = is_array($order->products) ? $order->products : json_decode($order->products, true);
        
        $pdf = Pdf::loadView('admin.orders.voucher', compact('order', 'products'));
        return $pdf->stream('voucher_'.$order->id.'.pdf');
    }
}

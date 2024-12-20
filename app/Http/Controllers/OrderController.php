<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Other methods...

    /**
     * Update the status of the order to 'success'.
     *
     * @param  int  $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus($orderId)
    {
        // Find the order by its ID
        $order = Order::findOrFail($orderId);

        // Only update if the status is 'pending'
        if ($order->status === 'pending') {
            $order->status = 'success';  // Update status to success
            $order->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Pesanan telah diterima!');
    }
}

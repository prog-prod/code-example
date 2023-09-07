<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class OrderTrashController extends Controller
{
    public function index()
    {
        $deletedOrders = Order::onlyTrashed()->paginate(10);

        return view('admin.trash.orders', compact('deletedOrders'));
    }

    public function restore(Order $order)
    {
        $order->restore();
        return redirect()->route('admin.trash.orders.index')->with(
            'success',
            'Orders has been restored.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order)
    {
        $order->forceDelete();

        return redirect()->route('admin.trash.orders.index')->with(
            ['success' => 'Order has been destroyed.']
        );
    }
}

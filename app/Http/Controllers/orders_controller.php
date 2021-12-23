<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class orders_controller extends Controller
{
    public function index()
    {
        $id = Auth::user();
        $orders = Order::findOrFail($id);
        return redirect()->view('users.orders.list',compact('orders'));
    }

    public function delete($deleteId)
    {
        Order_Detail::where('order_id',$deleteId)->destroy();
        Order::destroy($deleteId);
        return redirect()->route('user.order.list');
    }
}

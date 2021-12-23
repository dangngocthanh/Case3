<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
    public function buy(Request $request)
    {
        $user_id = Auth::user()->id;
        $total = 0;
        $products = $request->session()->get('cart' . $user_id);
        $counts = $request->session()->get('count' . $user_id);

        foreach ($products as $key => $product) {

            $product = Product::findOrFail($product->id);
            $product->quantity=$product->quantity-$counts[$key];
            $product->save();

            $payment = new Revenue();
            $payment->user_id = $user_id;
            $payment->product_id = $product->id;
            $payment->category_name = $product->category->name;
            $payment->quantity = $counts[$key];
            if ($product->sale_percent == 0) {
                $sale_price = $product->price;

            } else {
                $sale_price = $product->price - ($product->price / 100 * $product->sale_percent);
            }
            $payment->sale_price = $counts[$key] * $sale_price;
            $total += $counts[$key] * $sale_price;
            $payment->save();

        }

        $order = new Order();
        $order->user_id = $user_id;
        $order->total_price = $total;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->note = $request->note;
        $order->save();

        $order_id = Order::orderBy('id','desc')->limit(1)->get();
        $order_id = $order_id[0]->id;


        foreach ($products as $key => $product) {
            $detail = new Order_Detail();
            $detail->product_id = $product->id;
            $detail->quantity = $counts[$key];
            $detail->order_id = $order_id;
            $detail->save();
        }

        session(['count' . $user_id => []]);
        session(['count' => []]);
        session(['cart' . $user_id => []]);
        session(['cart' => []]);
        return redirect()->route('home');
    }

}

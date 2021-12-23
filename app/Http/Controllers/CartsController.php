<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartsController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::user()) {
            $user = Auth::user()->id;
            $products = $request->session()->get('cart' . $user);
            $count = $request->session()->get('count' . $user);
            if ($products == null) {
                $products = [];
                $count = [];
            }
            session(['count' => $count]);
            session(['cart' => $products]);
            return redirect()->route('user.home');
        }
        session(['count' => []]);
        session(['cart' => []]);
        return redirect()->route('user.home');

    }

    public function addToCart(Request $request, $id)
    {
        $user = Auth::user()->id;
        $products = $request->session()->get('cart' . $user);
        $count = $request->session()->get('count' . $user);
        $product = Product::findOrFail($id);

        if ($products == null) {
            $products = [];
            array_push($products, $product);
            session(['cart' => []]);
            session(['count' => []]);
            session()->push('cart', $product);
            session()->push('cart' . $user, $product);
            session()->push('count', 1);
            session()->push('count' . $user, 1);
            return redirect()->back();
        }

        for ($i = 0; $i < count($products); $i++) {
            if ($products[$i] == $product) {
                if($product->quantity == $count[$i]){
                    return redirect()->back()->with('error', 'We only have '.$count[$i].' products in this');
                }

                    $count[$i]++;
                session(['count' => $count]);
                session(['count' . $user => $count]);
                return redirect()->back();
            }
        }
        array_push($products, $product);
        session()->push('cart', $product);
        session()->push('cart' . $user, $product);
        session()->push('count', 1);
        session()->push('count' . $user, 1);
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user()->id;
        $products = $request->session()->get('cart' . $user);
        $count = $request->session()->get('count' . $user);
        array_splice($products, $id, 1);
        array_splice($count, $id, 1);
        session(['count' . $user => $count]);
        session(['count' => $count]);
        session(['cart' . $user => $products]);
        session(['cart' => $products]);
        return redirect()->back();

    }

}

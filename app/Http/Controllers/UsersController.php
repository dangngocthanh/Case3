<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\Revenue;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    function userHome()
    {
        $all = Revenue::all();
        foreach ($all as $revenue) {
            $top_products[$revenue->product_id] = [];
        }
        foreach ($all as $product) {

            if (!in_array($product->product_id, $top_products[$product->product_id])) {
                $top_products[$product->product_id] = ['name' => $product->product_id, 'price' => $product->sale_price];
            } else {
                $oldPrice = $top_products[$product->product_id]['price'] + $product->sale_price;
                $top_products[$product->product_id] = ['name' => $product->product_id, 'price' => $oldPrice];
            }
        }
        $top_products = collect($top_products);
        $top_products = $top_products->sortByDesc('price')->take(5);
        $all = [];
        foreach ($top_products as $top) {
            $product = Product::findOrFail($top['name']);
            array_push($all, $product);
        }

        $products = Product::orderBy('id', 'desc')->limit(5)->get();

        return view('users.home', compact('products', 'all'));


    }

    function home()
    {
        if (Gate::allows('admin')) {
            $today = new DateTime('today');
            $top_products = [];
            $top_user = [];
            $today_revenues = 0;
            $today_sale = 0;
            $total_revenues = 0;
            $total_sale = 0;
            foreach (Revenue::where('created_at', '>=', $today)->cursor() as $revenue) {
                $today_sale += $revenue->sale_price;
                $today_revenues += $revenue->quantity;
            }
            $all = Revenue::all();
            foreach ($all as $revenue) {
                $total_sale += $revenue->sale_price;
                $total_revenues += $revenue->quantity;
                $top_user[$revenue->user_id] = [];
                $top_products[$revenue->product_id] = [];
            }


            foreach ($all as $product) {
                if (!in_array($product->user_id, $top_user[$product->user_id])) {
                    $top_user[$product->user_id] = ['name' => $product->user_id, 'price' => $product->sale_price];
                } else {
                    $oldPrice = $top_user[$product->user_id]['price'] + $product->sale_price;
                    $top_user[$product->user_id] = ['name' => $product->user_id, 'price' => $oldPrice];
                }
                if (!in_array($product->product_id, $top_products[$product->product_id])) {
                    $top_products[$product->product_id] = ['name' => $product->product_id, 'price' => $product->sale_price];
                } else {
                    $oldPrice = $top_products[$product->product_id]['price'] + $product->sale_price;
                    $top_products[$product->product_id] = ['name' => $product->product_id, 'price' => $oldPrice];
                }
            }

            $top_user = collect($top_user);
            $top_products = collect($top_products);

            $top_user = $top_user->sortByDesc('price')->take(5);
            $top_products = $top_products->sortByDesc('price')->take(7);

            $users = [];
            $moneys = [];
            $products = [];

            foreach ($top_user as $top) {
                $user = User::findOrFail($top['name']);
                array_push($users, $user);
                array_push($moneys, $top['price']);
            }
            foreach ($top_products as $top) {
                $product = Product::findOrFail($top['name']);
                array_push($products, $product);
            }


            $total_orders = Order::all()->count();
            $today_orders = Order::where('created_at', '>=', $today)->count();


            return view('admin.home', compact('today_revenues', 'total_revenues', 'today_sale', 'total_sale', 'today_orders', 'total_orders', 'users', 'moneys', 'products'));
        } else {
            return redirect()->route('cart.reload');
        }
    }

    function index()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $users = User::all();
        return view('admin.users.list', compact('users'));
    }

    function edit($id)
    {
        if (!Gate::allows('view-admin-user'))
            $user = User::findOrFail($id);
        return view('users.profile.edit', compact('user'));
    }

    function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        if ($request->hasFile('image')) {
            // xoa anh cu
            Storage::delete('public/' . $user->image);
            //cap nhat anh moi
            $path = $request->file('image')->store('UserImg', 'public');
            $user->image = $path;
        }
        $user->save();
    }

    function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('users.profile.changePassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $userPassword = $user->password;

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password' => 'password not match']);
        }

        $user->password = Hash::make($request->password);


        $user->save();

        return redirect()->back()->with('success', 'password successfully updated');
    }

    function delete(Request $request)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        try {
            foreach ($request->deleteId as $id) {
                $delete_details = Order::where('user_id', $id)->select('id')->get();
                foreach ($delete_details as $detail_id) {
                    $delete_detail = Order_Detail::where('order_id', $detail_id)->select('id')->get();
                    Order_Detail::destroy($delete_detail);
                }
                Order::destroy($delete_details);
            }
            User::destroy($request->deleteId);
            $data = [
                'status' => 'success',
                'message' => 'Xoá thành công!'
            ];
        } catch (\Exception $exception) {
            $data = [
                'status' => 'error',
                'message' => 'Lỗi hệ thống!'
            ];
        }
        return response()->json($data);
    }

}

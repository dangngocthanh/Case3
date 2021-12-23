<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function search(Request $request)
    {
        try {
            $key = $request->key;
            $products = Product::where("name", 'like', '%' . $key . '%')->get();
            return view('users.product.search', compact('products'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    function detail($id){
        $product = Product::findOrFail($id);
        return view('users.product.detail_product',compact('product'));
    }
    function index()
    {
        if (!Gate::allows('admin')) {
            $products = Product::all();
            return view('users.product.list', compact('products'));
        }
        $products = Product::all();
        return view('admin.product.list', compact('products'));
    }

    function create()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    function edit($id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    function store(Request $request)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->sale_percent = $request->sale_percent;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('productImg', 'public');
            $product->image = $path;
        }

        $product->save();
        return redirect()->route('product.list');
    }

    function update(Request $request)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $product = Product::findOrFail($request->id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->sale_percent = $request->sale_percent;

        if ($request->hasFile('image')) {
            // xoa anh cu
            Storage::delete('public/' . $product->image);
            //cap nhat anh moi
            $path = $request->file('image')->store('ProductImg', 'public');
            $product->image = $path;
        }
        $product->save();
        return redirect()->route('product.list');
    }

    function delete(Request $request)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        try {
            foreach ($request->deleteId as $id) {
                    $delete_detail = Order_Detail::where('product_id', $id)->select('id')->get();
                    Order_Detail::destroy($delete_detail);
            }
            Product::destroy($request->deleteId);

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

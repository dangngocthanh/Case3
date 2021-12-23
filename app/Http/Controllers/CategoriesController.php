<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoriesController extends Controller
{
    function index()
    {
        if(!Gate::allows('admin')){
            abort(403);
        }

        $categories = Category::all();
        return view('admin.category.list', compact('categories'));
    }

    function create()
    {
        if(!Gate::allows('admin')){
            abort(403);
        }
        return view('admin.category.create');
    }

    function store(Request $request)
    {
        if(!Gate::allows('admin')){
            abort(403);
        }
        $category = new Category();
        $category->name = $request->name;
        $category->introduce = $request->introduce;
        $category->save();
        return redirect()->route('categories.list');
    }

    function edit($id)
    {
        if(!Gate::allows('admin')){
            abort(403);
        }
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    function update(Request $request)
    {
        if(!Gate::allows('admin')){
            abort(403);
        }
        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->introduce = $request->introduce;
        $category->save();
        return redirect()->route('categories.list');

    }

    function delete($id)
    {
        if(!Gate::allows('admin')){
            abort(403);
        }
        Product::where('category_id', $id)->update(['category_id'=>1]);
        Category::destroy($id);
        return redirect()->route('categories.list');
    }
}

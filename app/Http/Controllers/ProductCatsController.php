<?php

namespace App\Http\Controllers;

use App\Models\ProductCat;
use Illuminate\Http\Request;

class ProductCatsController extends Controller
{
    public function index()
    {
        return view('pages.categories.index');
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        $category = ProductCat::create($request->all());

        return redirect()->route('categories.index');
    }

    public function edit(ProductCat $category)
    {
        return view('pages.categories.edit', compact('category'));
    }


    public function update(Request $request, ProductCat $category)
    {
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy(ProductCat $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index()
    {
        return view('pages.stores.index');
    }

    public function create()
    {
        return view('pages.stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required',
            'store_province' => 'required',
            'store_city' => 'required',
            'store_district' => 'required',
            'store_village' => 'required',
            'phone' => 'required',
        ]);

        $store = Store::create($request->all());

        return redirect()->route('stores.index');
    }

    public function edit(Store $store)
    {
        return view('pages.stores.edit', compact('store'));
    }


    public function update(Request $request, Store $store)
    {
        $request->validate([
            'store_name' => 'required',
            'store_province' => 'required',
            'store_city' => 'required',
            'store_district' => 'required',
            'store_village' => 'required',
            'phone' => 'required',
        ]);

        $store->update($request->all());

        return redirect()->route('stores.index');
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('stores.index');
    }
}

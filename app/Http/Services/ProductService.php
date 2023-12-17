<?php

namespace App\Http\Services;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    public function isValidPrice($request)
    {
        if ($request->input('price') != 0 && $request->input('price_sale') != 0 && $request->input('price_sale') >= $request->input('price')) {
            $request->session()->flash('error', 'sale price must smaller than price');
            return false;
        }

        if ($request->input('price_sale') != 0 && (int)$request->input('price') == 0) {
            $request->session()->flash('error', 'price is required');
            return false;
        }

        return true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);

        if($isValidPrice == false) {
            return false;
        }

        try {
            $request->except('_token');
            Product::create($request->all());
            $request->session()->flash('success', 'Add product success');
        } catch (\Exception $err){
            $request->session()->flash('error', 'Add product failed');
            Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function getList()
    {
        return Product::with('menu')->orderByDesc('id')->paginate(15);
    }

    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);

        if($isValidPrice == false) {
            return false;
        }

        try {
            $product->fill($request->input());
            $product->save();
            $request->session()->flash('success', 'Update product success');
        } catch (\Exception $err){
            $request->session()->flash('error', 'Update product failed');
            Log::info($err->getMessage());
            return false;
        }
    }

    public function destroy($request)
    {
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }
}

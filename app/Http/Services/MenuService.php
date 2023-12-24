<?php

namespace App\Http\Services;

use App\Models\Menu;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Str;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAllParent()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function show()
    {
        return Menu::select('id', 'name')
        ->where('parent_id', 0)
        ->orderbyDesc('id')
        ->get();
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active')
            ]);
            $request->session()->flash('success', 'Add menu completed');
        } catch (\Exception $err) {
            $request->session()->flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function update($request, $menu): bool
    {
        if($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int) $request->input('parent_id');
        }
        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (string) $request->input('active');
        $menu->save();

        $request->session()->flash('success', 'Update complete');
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu)
    {
        return $menu->products()
        ->select('id', 'name', 'price', 'price_sale', 'thumb')
        ->where('active', '1')
        ->orderByDesc('id')
        ->paginate(12);
    }
}

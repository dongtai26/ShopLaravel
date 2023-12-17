<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Http\Services\MenuService;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function create()
    {
        return view('admin.menu.add', [
            'title' => 'Add menu',
            'menus' => $this->menuService->getParent(0)
        ]);
    }

    public function store(MenuRequest $request)
    {
        $result = $this->menuService->create($request);
        return redirect()->back();
    }

    public function index()
    {
        return view('admin.menu.list', [
            'title' => 'List menu',
            'menus' => $this->menuService->getAllParent()
        ]);
    }

    public function show(Menu $menu)
    {
        return view('admin.menu.edit', [
            'title' => 'Edit menu',
            'menu' => $menu,
            'menus' => $this->menuService->getAllParent()
        ]);

    }

    public function update(Menu $menu, MenuRequest $request)
    {
        $this->menuService->update($request, $menu);
        return redirect('/admin/menus/list');
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->menuService->destroy($request);
        if($result) {
            return response()->json([
                'error' => false,
                'message' => 'Delete complete'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}

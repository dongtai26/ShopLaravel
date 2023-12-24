<?php

namespace App\Http\Controllers;

use App\Http\Services\MenuService;
use App\Http\Services\ProductMainService;
use App\Http\Services\SliderService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $sliderService;
    protected $menuService;
    protected $productService;

    public function __construct(SliderService $sliderService, MenuService $menuService, ProductMainService $productService)
    {
        $this->sliderService = $sliderService;
        $this->menuService = $menuService;
        $this->productService = $productService;
    }

    public function index()
    {
        return view('main', [
            'title' => 'electric shop',
            'sliders' => $this->sliderService->show(),
            'menus' => $this->menuService->show(),
            'products' => $this->productService->get(),
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->productService->get($page);
        if(count($result) != 0) {
            $html = view('products.list', ['products' => $result])->render();

            return response()->json([
                'html' => $html
            ]);
        }

        return response()->json(['html' => '']);
    }
}

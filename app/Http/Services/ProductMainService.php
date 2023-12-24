<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductMainService
{
    const LIMIT = 16;

    public function get($page = null)
    {
        return Product::select('id', 'name', 'price_sale', 'thumb')
        ->orderByDesc('id')
        ->when($page != null, function ($query) use ($page) {
            $query->offset($page * Self::LIMIT);
        })
        ->limit(Self::LIMIT)
        ->get();
    }
}

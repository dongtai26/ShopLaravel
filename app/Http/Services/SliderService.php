<?php

namespace App\Http\Services;

use App\Models\Slider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SliderService
{
    public function insert($request)
    {
        try {
            Slider::create($request->all());
            $request->session()->flash('success', 'Add slider success');
        } catch (\Exception $err){
            $request->session()->flash('error', 'Add slider failed');
            Log::info($err->getMessage());
            return false;
        }

        return true;
    }
}

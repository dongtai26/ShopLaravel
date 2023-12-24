<?php

namespace App\Http\Services;

use App\Models\Slider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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

    public function get()
    {
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function show()
    {
        return Slider::where('active', 1)->orderByDesc('sort_by')->get();
    }

    public function update($request, $slider)
    {
        try {
            $slider->fill($request->input());
            $slider->save();
            $request->session()->flash('success', 'Update product success');
        } catch (\Exception $err){
            $request->session()->flash('error', 'Update product failed');
            Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();
        if ($slider) {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }
        return false;
    }
}

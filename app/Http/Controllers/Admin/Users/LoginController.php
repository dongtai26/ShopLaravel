<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return View('admin.users.login', [
            'title' => "Đăng nhập hệ thống"
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            // 'level' => 1
        ], $request->input('remember'))) {
            //name in route
            return redirect()->route('admin');
        };

        session()->flash('error','Wrong email or password');
        return redirect()->back();
    }
}

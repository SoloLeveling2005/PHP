<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanel extends Controller
{
    // todo выводит главный шаблон админки, если пользователь не авторизован(вызывается метод "authorize") отправляет на "login"
    public function index() {
        if (Auth::check()) {
            return view('admin', ['role'=>'admin']);
        }

        return view('admin', ['role'=>'guest']);
    }

    // todo выводит шаблон авторизации администрации, если пользователь авторизован(вызывается метод authorize) отправляет на "index"
    public function login(Request $request) {
        echo Auth::check();
        if (Auth::check()) {
            return view('admin', ['role'=>'admin']);
        }
        $val_data = $request->validate([
            'username'=>'required|string',
            'password'=>'required|string'
        ]);
        if (Auth::attempt(['username' => $val_data['username'], 'password' => $val_data['password']])) {
            // Аутентификация прошла успешно...
            return view('admin');
        }
        return "Nonono";
    }
    public function auth() {

    }
}

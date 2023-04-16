<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminPanel extends Controller
{
    // todo выводит главный шаблон админки
    public function index() {
        return view('admin');
    }

    // todo выводит шаблон авторизации администрации
    public function login(Request $request) {
        $val_data = $request->validate([
            'username'=>'required|string',
            'password'=>'required|string'
        ]);
        if (Auth::attempt(['username' => 'admin1', 'password' => Hash::make('hellouniverse1!')])) {

            // Аутентификация прошла успешно...
            return view('admin');
        }

        // todo Отправляем на страницу с статусом гость для регистрации
        return 0;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanel extends Controller
{
    // todo выводит главный шаблон админки, если пользователь не авторизован(вызывается метод "authorize") отправляет на "login"
    public function index() {

    }

    // todo выводит шаблон авторизации администрации, если пользователь авторизован(вызывается метод authorize) отправляет на "index"
    public function login() {

    }
    public function authorize() {

    }
}

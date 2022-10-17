<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // login page
    public function loginPage(){
        return view('login');
    }
    // register page
    public function registerPage(){
        return view('register');
    }
    // logout manual with get method
    public function log_out(){
        Auth::logout();
        return to_route('auth#loginPage');//laravel-9 helper function
    }
    // Direct dashboard
    public function dashboard(){
        if (auth()->user()->role === 'admin') {
            return to_route('category#list');//laravel-9 helper function
        }else {
            return to_route('user#home');//laravel-9 helper function
        }
    }

}

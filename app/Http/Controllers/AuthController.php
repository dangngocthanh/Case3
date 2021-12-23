<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\validateAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function formRegister()
    {
        return view('register');
    }

    public function register(AuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('user.formRegister');

    }

    public function formLogin()
    {
        return view('login');
    }

    public function Login(validateAccount $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            return redirect()->route('home');
        } else {
            Session::flash('errorLogin', 'Tài khoản hoặc mật khẩu không chính xác');
            return redirect()->route('user.formLogin');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.formLogin');
    }

}

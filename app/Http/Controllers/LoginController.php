<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt($request)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', "Your email or password is incorrect, please try again.");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/login");
    }
}

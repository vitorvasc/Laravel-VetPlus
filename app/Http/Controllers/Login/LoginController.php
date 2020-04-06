<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $req)
    {
        $data = $req->all();
        $user = User::where('email', $data['email'])->first();

        $message = [
            'type' => 'error',
            'text' => 'Oops! Usuário ou senha incorretos. Tente novamente.'
        ];

        if (!$user) {
            return view('login.index', ['message' => $message]);
        }

        $auth = Hash::check($data['password'], $user->password);

        if ($auth) {
            Auth::loginUsingId($user->id);
            return redirect()->route('site.home');
        } else {
            return view('login.index', ['message' => $message]);
        }
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return view('user.login',[
            'title' => 'Login'
        ]);
    }

    public function doLogin()
    {
        $user = request()->input('user');
        $password = request()->input('password');

        if(!isset($user) || !isset($user)){
            return response()->view('user.login',[
                'title' => 'Login',
                'error' => 'Username atau Password harus diisi',
            ]);
        }

        if($this->userService->login($user,$password)){
            session()->put('user',$user);
            return redirect('/')->with('coba','coba');
        }

        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'Username atau Password salah',
        ]);
    }

    public function doLogout()
    {
        session()->forget('user');
        return redirect('/');
    }
}

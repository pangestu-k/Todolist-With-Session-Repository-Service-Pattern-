<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if(session()->has('user')){
            return redirect('todolist');
        }else{
            return redirect('login');
        }
    }
}

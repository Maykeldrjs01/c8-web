<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        if (auth()->user()->is_admin){
            return redirect()->route('admin.dashboard.index');
        }
        else{
            return redirect()->route('user.dashboard.index');
        }
    }
}

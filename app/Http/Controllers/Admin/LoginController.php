<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function toLogin()
    {
//  	dd($_SERVER);
        return view('admin.login');
    }
}

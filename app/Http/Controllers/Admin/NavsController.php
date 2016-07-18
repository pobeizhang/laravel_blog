<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Navs;

class NavsController extends Controller
{
    //加载友情链接添加页面
    public function toNavsAdd()
    {
        return view('admin.navsAdd');
    }

    //加载友情链接修改页面
    public function toNavsList()
    {
        $navs=Navs::orderBy('order')->get();
        return view('admin.navsList')->with('navs',$navs);
    }

    //加载友情链接修改页面
    public function toNavsEdit(Request $request,$id)
    {
        $navs=Navs::where('id',$id)->first();

        return view('admin.navsEdit')->with('navs',$navs);
    }
}

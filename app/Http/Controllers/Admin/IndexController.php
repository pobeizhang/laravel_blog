<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //后台首页
    public function toIndex(Request $request)
	{
		$admin_username=$request->session()->get('admin_username','');
		return view('admin.index')->with('admin_username',$admin_username);
	}
	
	//退出登录
	public function loginout(Request $request)
	{
		$request->session()->put('admin_username',null);
		return redirect('admin/login');
	}
	
	//后台信息页面
	public function toInfo()
	{
		return view('admin.info');
	}
	
	//修改密码
	public function toPass()
	{
		return view('admin.pass');
	}
	
}

<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Member;
use App\Models\M3Result;

class MemberController extends Controller
{
	//后台登录验证
    public function member(Request $request)
	{
		$username=$request->input('username','');
		$password=$request->input('password','');
		$code=$request->input('code','');
		$m3_result=new M3Result;
		if($username==''){
			$m3_result->status=1;
			$m3_result->message='用户名不能为空';
			return $m3_result->toJson();
		}
		if($password==''){
			$m3_result->status=2;
			$m3_result->message='密码不能为空';
			return $m3_result->toJson();
		}
		if($code==''){
			$m3_result->status=3;
			$m3_result->message='验证码不能为空';
			return $m3_result->toJson();
		}
		$member=Member::where('username',$username)->first();
		if($member == null){
			$m3_result->status=4;
			$m3_result->message='用户不存在';
			return $m3_result->toJson();
		}
		if($username != $member->username){
			$m3_result->status=5;
			$m3_result->message='用户名不正确';
			return $m3_result->toJson();
		}
		if(md5($password) != $member->password){
			$m3_result->status=6;
			$m3_result->message='密码不正确';
			return $m3_result->toJson();
		}
		if($code != $request->session()->get('code')){
			$m3_result->status=7;
			$m3_result->message='验证码不正确';
			return $m3_result->toJson();
		}
		
		$request->session()->put('admin_username',$member->username);
		$m3_result->status=0;
		$m3_result->message='欢迎登录后台';
		return $m3_result->toJson();
	}

	//后台登录密码的修改
	public function changPass(Request $request)
	{
		$m3_result=new M3Result;
		$password_o=$request->input('password_o','');
		$password=$request->input('password','');
		$password_c=$request->input('password_c','');
		
		if($password_o==''){
			$m3_result->status=1;
			$m3_result->message='请填写要修改的密码';
			return $m3_result->toJson();
		}
		if($password==''){
			$m3_result->status=2;
			$m3_result->message='请填写你的新密码';
			return $m3_result->toJson();
		}
		if($password_c==''){
			$m3_result->status=3;
			$m3_result->message='请再次填写你的新密码';
			return $m3_result->toJson();
		}
		if(strlen($password)<6 || strlen($password)>20){
			$m3_result->status=4;
			$m3_result->message='密码必须是6到20位之间的字符';
			return $m3_result->toJson();
		}
		if($password != $password_c){
			$m3_result->status=5;
			$m3_result->message="两次输入的新密码不一致";
			return $m3_result->toJson();
		}
		$username=$request->session()->get('admin_username','');
		$user_info=Member::where('username',$username)->first();
		if(md5($password_o) != $user_info->password){
			$m3_result->status=6;
			$m3_result->message="你输入的密码不正确";
			return $m3_result->toJson();
		}
		
		$user_info->password=md5($password);
		$user_info->update();
		
		$m3_result->status=0;
		$m3_result->message="密码修改成功";
		return $m3_result->toJson();
	}
}

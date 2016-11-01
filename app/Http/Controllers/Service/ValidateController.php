<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tool\Validate\ValidateCode;
class ValidateController extends Controller
{
	//验证码的生成函数
    public function create(Request $request)
    {
        $validate=new ValidateCode;
        $request->session()->put('code',$validate->getCode());
        return $validate->doimg();
    }
	
}

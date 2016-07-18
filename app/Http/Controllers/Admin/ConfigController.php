<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Config;

class ConfigController extends Controller
{
    //添加配置项
    public function toConfigAdd()
    {
        return view('admin.configAdd');
    }

    //配置项列表
    public function toConfigList()
    {
        $configs=Config::orderBy('order')->get();
        foreach($configs as $k=>$v){
            switch($v->type){
                case 'input':
                    $configs[$k]['_html']='<input type="text" class="lg mark" name="content[]" value="'.$v->content.'">';
                    break;
                case 'textarea':
                    $configs[$k]['_html']='<textarea class="lg mark" name="content[]">'.$v->content.'</textarea>';
                    break;
                case 'radio':
                    $arr1=explode(',',$v->value);
                    $str='';
                    foreach($arr1 as $kk=>$vv){
                        $arr2=explode('|',$vv);
                        $checked='';
                        if($v->content == $arr2[0]){
                            $checked='checked';
                        }
                        $str.='<input type="radio" '.$checked.' name="content[]" value="'.$arr2[0].'">'.$arr2[1].'&nbsp;';
                    }
                    $configs[$k]['_html']=$str;
                    break;
            }
        }
        return view('admin.configList')->with('configs',$configs);
    }

    //配置项修改
    public function toConfigEdit($id){
        $config=Config::where('id',$id)->first();
        return view('admin.configEdit')->with('config',$config);
    }
}
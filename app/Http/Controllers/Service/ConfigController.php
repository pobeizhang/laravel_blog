<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Config;
use App\Models\M3Result;

class ConfigController extends Controller
{
    //配置项添加
    public function configAdd(Request $request)
    {
        $m3_result=new M3Result;
        $title=$request->input('title','');
        $name=$request->input('name','');
        $type=$request->input('type','');
        $value=$request->input('value','');
        $order=$request->input('order','');
        $tips=$request->input('tips','');
        if($title == ''){
            $m3_result->status=1;
            $m3_result->message='请填写配置项标题';
            return $m3_result->toJson();
        }
        if($name == ''){
            $m3_result->status=2;
            $m3_result->message='请填写配置项名称';
            return $m3_result->toJson();
        }
        if($type == ''){
            $m3_result->status=3;
            $m3_result->message='请填写类型';
            return $m3_result->toJson();
        }
        if($order== ''){
            $m3_result->status=5;
            $m3_result->message='请填写排序';
            return $m3_result->toJson();
        }

        $config=new Config;
        $config->title=$title;
        $config->name=$name;
        $config->type=$type;
        $config->value=$value;
        $config->order=$order;
        $config->tips=$tips;
        $config->save();
        $m3_result->status=0;
        $m3_result->message='配置项添加成功';
        $this->putConfig();
        return $m3_result->toJson();
    }

    //配置项修改
    public function configEdit(Request $request)
    {
        $m3_result=new M3Result;
        $id=$request->input('id','');
        $title=$request->input('title','');
        $name=$request->input('name','');
        $type=$request->input('type','');
        $value=$request->input('value','');
        $order=$request->input('order','');
        $tips=$request->input('tips','');
        if($title == ''){
            $m3_result->status=1;
            $m3_result->message='请填写配置项标题';
            return $m3_result->toJson();
        }
        if($name == ''){
            $m3_result->status=2;
            $m3_result->message='请填写配置项名称';
            return $m3_result->toJson();
        }
        if($type == ''){
            $m3_result->status=3;
            $m3_result->message='请填写类型';
            return $m3_result->toJson();
        }
        if($order== ''){
            $m3_result->status=5;
            $m3_result->message='请填写排序';
            return $m3_result->toJson();
        }

        $config=Config::where('id',$id)->first();
        $config->title=$title;
        $config->name=$name;
        $config->type=$type;
        $config->value=$value;
        $config->order=$order;
        $config->tips=$tips;
        $config->update();
        $m3_result->status=0;
        $m3_result->message='配置项添加成功';
        $this->putConfig();
        return $m3_result->toJson();
    }

    //配置项排序
    public function configOrder(Request $request){
        $id=$request->input('id','');
        $order=$request->input('order','');
        $config=Config::where('id',$id)->first();
        $config->order=$order;
        $res=$config->update();
        $m3_result=new M3Result;
        if($res){
            $m3_result->status=0;
            $m3_result->message='排序更新成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=1;
            $m3_result->message='排序更新失败';
            return $m3_result->toJson();
        }
    }

    //单条删除配置项
    public function configDel(Request $request)
    {
        $m3_result=new M3Result;
        $id=$request->input('id','');
        $res=Config::where('id',$id)->delete();
        if($res){
            $m3_result->status=0;
            $m3_result->message='配置项删除成功';
            $this->putConfig();
            return $m3_result->toJson();

        }else{
            $m3_result->status=1;
            $m3_result->message='配置项删除失败';
            return $m3_result->toJson();
        }
    }

    //配置项内容的修改
    public function configContentEdit(Request $request)
    {
        $m3_result=new M3Result;
        $configContents=$request->except('_token','delAll','order');
        foreach($configContents['ids'] as $k=>$v){
            Config::where('id',$v)->update(['content'=>$configContents['content'][$k]]);
        }
        $m3_result->status=0;
        $m3_result->message='配置项的内容更新成功';
        $this->putConfig();
        return $m3_result->toJson();
    }

    //写入配置文件
    public function putConfig()
    {
//        echo \Illuminate\Support\Facades\Config::get('webConfig.web_title');
        $configs=Config::pluck('content','name')->all();
        $msg=var_export($configs,true);
        $path=base_path().'\config\webConfig.php';
        file_put_contents($path,'<?php return '.$msg.';');
    }
}

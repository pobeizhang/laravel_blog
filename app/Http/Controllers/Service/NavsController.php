<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use App\Entity\Navs;

class NavsController extends Controller
{
    //后台自定义导航添加
    public function navsAdd(Request $request)
    {
        $m3_result=new M3Result;
        $name=$request->input('name','');
        $alias=$request->input('alias','');
        $url=$request->input('url','');
        $order=$request->input('order','');
        if($name == ''){
            $m3_result->status=1;
            $m3_result->message='请填写自定义导航名称';
            return $m3_result->toJson();
        }
        if($alias == ''){
            $m3_result->status=2;
            $m3_result->message='请填写自定义导航别称';
            return $m3_result->toJson();
        }
        if($url == ''){
            $m3_result->status=3;
            $m3_result->message='请填写自定义导航地址';
            return $m3_result->toJson();
        }
        if($order == ''){
            $m3_result->status=5;
            $m3_result->message='请填写自定义导航排序';
            return $m3_result->toJson();
        }
        if(!is_numeric($order)){
            $m3_result->status=6;
            $m3_result->message='排序序号必须是数字';
            return $m3_result->toJson();
        }
        $navs=new Navs;
        $navs->name=$name;
        $navs->alias=$alias;
        $navs->url=$url;
        $navs->order=$order;
        $res=$navs->save();
        if($res){
            $m3_result->status=0;
            $m3_result->message='自定义导航添加成功';
            return $m3_result->toJson();
        }else{
            return;
        }
    }

    //后台友情链接排序接口
    public function navsOrder(Request $request)
    {
        $id=$request->input('id','');
        $order=$request->input('order','');
        $navs=Navs::where('id',$id)->first();
        $navs->order=$order;
        $res=$navs->update();
        $m3_result=new M3Result;
        if($res){
            $m3_result->status=0;
            $m3_result->message='排序更新成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=1;
            $m3_result->message='排序更新出错';
            return $m3_result->toJson();
        }

    }

    //后台自定义导航修改
    public function navsEdit(Request $request)
    {
        $m3_result=new M3Result;
        $id=$request->input('id','');
        $name=$request->input('name','');
        $alias=$request->input('alias','');
        $url=$request->input('url','');
        $order=$request->input('order','');
        if($name == ''){
            $m3_result->status=1;
            $m3_result->message='请填写自定义导航名称';
            return $m3_result->toJson();
        }
        if($alias == ''){
            $m3_result->status=2;
            $m3_result->message='请填写自定义导航别称';
            return $m3_result->toJson();
        }
        if($url == ''){
            $m3_result->status=3;
            $m3_result->message='请填写自定义导航地址';
            return $m3_result->toJson();
        }
        if($order == ''){
            $m3_result->status=5;
            $m3_result->message='请填写自定义导航排序';
            return $m3_result->toJson();
        }
        if(!is_numeric($order)){
            $m3_result->status=6;
            $m3_result->message='排序序号必须是数字';
            return $m3_result->toJson();
        }
        $navs=Navs::where('id',$id)->first();
        $navs->name=$name;
        $navs->alias=$alias;
        $navs->url=$url;
        $navs->order=$order;
        $res=$navs->update();
        if($res){
            $m3_result->status=0;
            $m3_result->message='自定义导航修改成功';
            return $m3_result->toJson();
        }else{
            return;
        }
    }

    //删除一条自定义导航
    public function navDel(Request $request)
    {
        $m3_result=new M3Result;
        $id=$request->input('id','');
        $res=Navs::where('id',$id)->delete();
        if($res){
            $m3_result->status=0;
            return $m3_result->toJson();
            $m3_result->message='自定义导航删除成功';
        }else{
            $m3_result->status=1;
            $m3_result->message='自定义导航删除失败';
            return $m3_result->toJson();
        }
    }

    //批量删除友情链接
    public function navsDel(Request $request)
    {
        $m3_result=new M3Result;
        $ids=$request->input('ids','');
        $count=count(Navs::all());
        if($count == count($ids)){
            $res=Navs::truncate();
        }else{
            $res=Navs::whereIn('id',$ids)->delete();
        }

        if($res){
            $m3_result->status=0;
            $m3_result->message='自定义导航删除成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=1;
            $m3_result->message='删除自定义导航时出现未知错误';
            return $m3_result->toJson();
        }
    }
}

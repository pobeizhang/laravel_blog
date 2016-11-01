<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use App\Entity\Friendlinks;

class FriendLinksController extends Controller
{
    //后台友情链接添加
    public function friendLinksAdd(Request $request)
    {
        $m3_result=new M3Result;
        $name=$request->input('name','');
        $title=$request->input('title','');
        $url=$request->input('url','');
        $order=$request->input('order','');
        if($name == ''){
            $m3_result->status=1;
            $m3_result->message='请填写友情链接名称';
            return $m3_result->toJson();
        }
        if($title == ''){
            $m3_result->status=2;
            $m3_result->message='请填写友情链接简介';
            return $m3_result->toJson();
        }
        if($url == ''){
            $m3_result->status=3;
            $m3_result->message='请填写友情链接地址';
            return $m3_result->toJson();
        }
        if($order == ''){
            $m3_result->status=5;
            $m3_result->message='请填写友情链接排序';
            return $m3_result->toJson();
        }
        if(!is_numeric($order)){
            $m3_result->status=6;
            $m3_result->message='分类排序序号必须是数字';
            return $m3_result->toJson();
        }
        $friendLinks=new Friendlinks;
        $friendLinks->name=$name;
        $friendLinks->title=$title;
        $friendLinks->url=$url;
        $friendLinks->order=$order;
        $res=$friendLinks->save();
        if($res){
            $m3_result->status=0;
            $m3_result->message='友情链接添加成功';
            return $m3_result->toJson();
        }else{
            return;
        }
    }

    //后台友情链接排序接口
    public function friendLinksOrder(Request $request)
    {
        $id=$request->input('id','');
        $order=$request->input('order','');
        $friendLink=FriendLinks::where('id',$id)->first();
        $friendLink->order=$order;
        $res=$friendLink->update();
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

    //后台友情链接修改
    public function friendLinksEdit(Request $request)
    {
        $m3_result=new M3Result;
        $id=$request->input('id','');
        $name=$request->input('name','');
        $title=$request->input('title','');
        $url=$request->input('url','');
        $order=$request->input('order','');
        if($name == ''){
            $m3_result->status=1;
            $m3_result->message='请填写友情链接名称';
            return $m3_result->toJson();
        }
        if($title == ''){
            $m3_result->status=2;
            $m3_result->message='请填写友情链接简介';
            return $m3_result->toJson();
        }
        if($url == ''){
            $m3_result->status=3;
            $m3_result->message='请填写友情链接地址';
            return $m3_result->toJson();
        }
        if($order == ''){
            $m3_result->status=5;
            $m3_result->message='请填写友情链接排序';
            return $m3_result->toJson();
        }
        if(!is_numeric($order)){
            $m3_result->status=6;
            $m3_result->message='分类排序序号必须是数字';
            return $m3_result->toJson();
        }
        $friendLinks=Friendlinks::where('id',$id)->first();
        $friendLinks->name=$name;
        $friendLinks->title=$title;
        $friendLinks->url=$url;
        $friendLinks->order=$order;
        $res=$friendLinks->update();
        if($res){
            $m3_result->status=0;
            $m3_result->message='友情链接修改成功';
            return $m3_result->toJson();
        }else{
            return;
        }
    }

    //删除一条友情连接
    public function friendLinkDel(Request $request)
    {
        $m3_result=new M3Result;
        $id=$request->input('id','');
        $res=Friendlinks::where('id',$id)->delete();
        if($res){
            $m3_result->status=0;
            return $m3_result->toJson();
            $m3_result->message='友情链接删除成功';
        }else{
            $m3_result->status=1;
            $m3_result->message='友情链接删除失败';
            return $m3_result->toJson();
        }
    }

    //批量删除友情链接
    public function friendLinksDel(Request $request)
    {
        $m3_result=new M3Result;
        $ids=$request->input('ids','');
        $count=count(Friendlinks::all());
        if($count == count($ids)){
            $res=Friendlinks::truncate();
        }else{
            $res=Friendlinks::whereIn('id',$ids)->delete();
        }

        if($res){
            $m3_result->status=0;
            $m3_result->message='友情链接删除成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=1;
            $m3_result->message='删除友情链接时出现未知错误';
            return $m3_result->toJson();
        }
    }
}

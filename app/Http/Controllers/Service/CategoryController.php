<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Models\M3Result;
use App\Models\Data;

class CategoryController extends Controller
{
    //后台分类排序接口
    public function cateOrder(Request $request)
    {
        $id=$request->input('id','');
        $order=$request->input('order','');
        $cates=Category::where('id',$id)->first();
        $cates->order=$order;
        $res=$cates->update();
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

    //后台分类添加接口
    public function cateAdd(Request $request)
    {
        $m3_result=new M3Result;
        $pid=$request->input('pid','');
        $name=$request->input('name','');
        $title=$request->input('title','');
        $key=$request->input('key','');
        $description=$request->input('description','');
        $order=$request->input('order','');
        if($name == ''){
            $m3_result->status=1;
            $m3_result->message='请填写分类名称';
            return $m3_result->toJson();
        }
        if($title == ''){
            $m3_result->status=2;
            $m3_result->message='请填写分类标题';
            return $m3_result->toJson();
        }
        if($key == ''){
            $m3_result->status=3;
            $m3_result->message='请填写分类关键词';
            return $m3_result->toJson();
        }
        if($description == ''){
            $m3_result->status=4;
            $m3_result->message='请填写分类描述';
            return $m3_result->toJson();
        }
        if($order == ''){
            $m3_result->status=5;
            $m3_result->message='请填写分类排序序号';
            return $m3_result->toJson();
        }
        if(!is_numeric($order)){
            $m3_result->status=6;
            $m3_result->message='分类排序序号必须是数字';
            return $m3_result->toJson();
        }
        $category=new Category;
        $category->name=$name;
        $category->title=$title;
        $category->key=$key;
        $category->description=$description;
        $category->order=$order;
        $category->pid=$pid;
        $res=$category->save();
        if($res){
            $m3_result->status=0;
            $m3_result->message='分类添加成功';
            return $m3_result->toJson();
        }else{
            return;
        }
    }

    //后台分类删除接口
    public function cateDel(Request $request)
    {
        $m3_result=new M3Result;

        $id=$request->input('id','');
        $sids=Category::where('pid',$id)->lists('id');
        $ids=[];
        foreach($sids as $k=>$v){
            $ids[]=$v;
        }
        $ids[]=$id;

        $res=Category::whereIn('id',$ids)->delete();
        if($res){
            $m3_result->status=0;
            $m3_result->message='分类删除成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=1;
            $m3_result->message='删除分类时出现未知错误';
            return $m3_result->toJson();
        }
    }

    //后台批量删除分类接口
    public function catesDel(Request $request)
    {
        $m3_result=new M3Result;
        $ids=$request->input('ids','');
        $count=count(Category::all());
        if($count == count($ids)){
            $res=Category::truncate();
        }else{
            $res=Category::whereIn('id',$ids)->delete();
        }

        if($res){
            $m3_result->status=0;
            $m3_result->message='分类删除成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=1;
            $m3_result->message='删除分类时出现未知错误';
            return $m3_result->toJson();
        }
    }

    //后台分类修改接口
    public function cateEdit(Request $request)
    {
        $m3_result=new M3Result;
        $id=$request->input('id','');
        $pid=$request->input('pid','');
        $name=$request->input('name','');
        $title=$request->input('title','');
        $key=$request->input('key','');
        $description=$request->input('description','');
        $order=$request->input('order','');
        if($name == ''){
            $m3_result->status=1;
            $m3_result->message='请填写分类名称';
            return $m3_result->toJson();
        }
        if($title == ''){
            $m3_result->status=2;
            $m3_result->message='请填写分类标题';
            return $m3_result->toJson();
        }
        if($key == ''){
            $m3_result->status=3;
            $m3_result->message='请填写分类关键词';
            return $m3_result->toJson();
        }
        if($description == ''){
            $m3_result->status=4;
            $m3_result->message='请填写分类描述';
            return $m3_result->toJson();
        }
        if($order == ''){
            $m3_result->status=5;
            $m3_result->message='请填写分类排序序号';
            return $m3_result->toJson();
        }
        if(!is_numeric($order)){
            $m3_result->status=6;
            $m3_result->message='分类排序序号必须是数字';
            return $m3_result->toJson();
        }
        $category=Category::where('id',$id)->first();
        $category->name=$name;
        $category->title=$title;
        $category->key=$key;
        $category->description=$description;
        $category->order=$order;
        $category->pid=$pid;
        $res=$category->update();
        if($res){
            $m3_result->status=0;
            $m3_result->message='分类修改成功';
            return $m3_result->toJson();
        }else{
            return 123;
        }
    }
}

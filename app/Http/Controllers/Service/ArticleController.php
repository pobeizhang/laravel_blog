<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use App\Entity\Article;

class ArticleController extends Controller
{
    //缩略图上传
    public function uploadThumb(Request $request)
    {
        $file=$request->file('Filedata');
        if(!$request->hasFile('Filedata')){
            return '上传文件不存在';
        }
        if(!$file->isValid()){
            return '上传出错';
        }

        //上传文件的后缀
        $ext=$file->getClientOriginalExtension();
        $newName=date('YmdHis').mt_rand(100,999).'.'.$ext;
        $path=$file->move(base_path().'/public/uploads',$newName);
        //使用文件所在的相对路径
        $filePath='uploads/'.$newName;
        return $filePath;
    }

    //文章提交
    public function articleAdd(Request $request)
    {
        $m3_result=new M3Result;

        $id=$request->input('id','');
        $title=$request->input('title','');
        $editor=$request->input('editor','');
        $thumb=$request->input('thumb','');
        $key=$request->input('key','');
        $description=$request->input('description','');
        $content=$request->input('content','');
        if($title == ''){
            $m3_result->status=1;
            $m3_result->message='请填写文章标题';
            return $m3_result->toJson();
        }
        if($editor == ''){
            $m3_result->status=2;
            $m3_result->message='请填写文章作者';
            return $m3_result->toJson();
        }
        if($thumb == ''){
            $m3_result->status=3;
            $m3_result->message='请上传文章缩略图';
            return $m3_result->toJson();
        }
        if($key == ''){
            $m3_result->status=4;
            $m3_result->message='请填写文章关键词';
            return $m3_result->toJson();
        }
        if($description == ''){
            $m3_result->status=5;
            $m3_result->message='请填写文章描述';
            return $m3_result->toJson();
        }
        if($content == ''){
            $m3_result->status=6;
            $m3_result->message='请填写文章内容';
            return $m3_result->toJson();
        }

        $article=new Article;
        $article->title=$title;
        $article->editor=$editor;
        $article->key=$key;
        $article->description=$description;
        $article->thumb=$thumb;
        $article->content=$content;
        $article->cid=$id;
        $res=$article->save();
        if($res){
            $m3_result->status=0;
            $m3_result->message='文章添加成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=7;
            $m3_result->message='文章添加失败';
            return $m3_result->toJson();
        }
    }

    //文章修改
    public function articleEdit(Request $request)
    {
        $m3_result=new M3Result;

        $id=$request->input('id','');
        $cid=$request->input('cid','');
        $title=$request->input('title','');
        $editor=$request->input('editor','');
        $thumb=$request->input('thumb','');
        $key=$request->input('key','');
        $description=$request->input('description','');
        $content=$request->input('content','');
        if($title == ''){
            $m3_result->status=1;
            $m3_result->message='请填写文章标题';
            return $m3_result->toJson();
        }
        if($editor == ''){
            $m3_result->status=2;
            $m3_result->message='请填写文章作者';
            return $m3_result->toJson();
        }
        if($thumb == ''){
            $m3_result->status=3;
            $m3_result->message='请上传文章缩略图';
            return $m3_result->toJson();
        }
        if($key == ''){
            $m3_result->status=4;
            $m3_result->message='请填写文章关键词';
            return $m3_result->toJson();
        }
        if($description == ''){
            $m3_result->status=5;
            $m3_result->message='请填写文章描述';
            return $m3_result->toJson();
        }
        if($content == ''){
            $m3_result->status=6;
            $m3_result->message='请填写文章内容';
            return $m3_result->toJson();
        }

        $article=Article::where('id',$id)->first();
        $article->title=$title;
        $article->editor=$editor;
        $article->key=$key;
        $article->description=$description;
        $article->thumb=$thumb;
        $article->content=$content;
        $article->cid=$cid;
        $res=$article->update();
        if($res){
            $m3_result->status=0;
            $m3_result->message='文章修改成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=7;
            $m3_result->message='文章修改失败';
            return $m3_result->toJson();
        }
    }

    //单独删除文章
    public function articleDel(Request $request)
    {
        $m3_result=new M3Result;
        $id=$request->input('id','');
        $res=Article::where('id',$id)->delete();
        if($res){
            $m3_result->status=0;
            $m3_result->message='文章删除成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=1;
            $m3_result->message='文章删除失败';
            return $m3_result->toJson();
        }
    }

    //批量删除文章
    public function articlesDel(Request $request)
    {
        $m3_result=new M3Result;
        $ids=$request->input('ids','');
        $count=count(Article::all());
        if($count == count($ids)){
            $res=Article::truncate();
        }else{
            $res=Article::whereIn('id',$ids)->delete();
        }

        if($res){
            $m3_result->status=0;
            $m3_result->message='文章删除成功';
            return $m3_result->toJson();
        }else{
            $m3_result->status=1;
            $m3_result->message='删除文章时出现未知错误';
            return $m3_result->toJson();
        }
    }
}

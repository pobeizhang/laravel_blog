<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Entity\Article;
use App\Models\M3Result;
use App\Models\Data;
use DB;

class ArticleController extends Controller
{
    //加载添加文章页面
    public function toArticleAdd()
    {
        $categorys=Category::orderBy('order')->get();
        $data=new Data;
        $data=$data->tree($categorys,'name','id');
        return view('admin.articleAdd')->with('categorys',$data);
    }

    //文章列表
    public function toArticleList()
    {
        $articles=DB::table('category')->join('article','article.cid','=','category.id')->paginate(6);
//        p(Article::all());
        return view('admin.articleList')->with('articles',$articles);
    }

    //修改文章
    public function toArticleEdit($id)
    {
        $categorys=Category::orderBy('order')->get();
        $data=new Data;
        $categorys=$data->tree($categorys,'name','id');

        $article=Article::where('id',$id)->first();
        return view('admin.articleEdit')->with('article',$article)
                                        ->with('categorys',$categorys);
    }

}

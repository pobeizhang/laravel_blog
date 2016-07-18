<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Friendlinks;
use DB;
use App\Models\Data;

class IndexController extends Controller
{
    //加载前台首页
    public function toIndex()
    {
//        文章推荐
        $articles=Article::orderBy('created_at','desc')->paginate(5);
        foreach($articles as $k=>$v){
            $articles[$k]['cate_name']=Category::where('id',$v->cid)->value('name');
        }
//        dd($articles);die;
        //站长推荐
        $recommends=Article::orderBy('viewCount','desc')->take(6)->get();

        //友情链接
        $links=Friendlinks::all();

        //所有顶级分类
        $topCates=Category::where('pid',0)->get();

        return view('home.index')->with('articles',$articles)
                                 ->with('recommends',$recommends)
                                 ->with('links',$links)
                                 ->with('topCates',$topCates);
    }

    //加载newList页面
    public function toNewList($id)
    {
        //分类查看次数递增
        Category::where('id',$id)->increment('viewCount');
        $cids=Category::where('pid',$id)->lists('id')->toArray();
        $articles=Article::whereIn('cid',$cids)->orderBy('created_at','desc')->paginate(5);
        foreach($articles as $k=>$v){
            $articles[$k]['cate_name']=Category::where('id',$v->cid)->value('name');
            $articles[$k]['cate_id']=Category::where('id',$v->cid)->value('id');
        }
        $cate=Category::where('id',$id)->first();

        $categorys=Category::whereIn('id',$cids)->get();
        return view('home.newList')->with('articles',$articles)
                                    ->with('categorys',$categorys)
                                    ->with('cate',$cate);
    }

    public function toTwoList($id)
    {
        //分类查看次数递增
        Category::where('id',$id)->increment('viewCount');
        $articles=Article::where('cid',$id)->orderBy('created_at','desc')->paginate(5);
        foreach($articles as $k=>$v){
            $articles[$k]['cate_name']=Category::where('id',$v->cid)->value('name');
            $articles[$k]['cate_id']=Category::where('id',$v->cid)->value('id');
        }
        $cate=Category::where('id',$id)->first();
        return view('home.twoList')->with('articles',$articles)
                                    ->with('cate',$cate);
    }

    //加载new页面
    public function toNew($id)
    {
        //文章查看次数递增
        Article::where('id',$id)->increment('viewCount');
        $articleContent=Article::where('id',$id)->first();
        $cid=Article::where('id',$id)->value('cid');
        //面包屑
        $categorys=Category::all()->toArray();
        $data=new Data;
        $data=$data->parentChannel($categorys, $cid);
        sort($data);
        return view('home.new')->with('articleContent',$articleContent)
                               ->with('cates',$data);//面包屑
    }
}

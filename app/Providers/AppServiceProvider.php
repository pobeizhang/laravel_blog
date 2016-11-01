<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entity\Navs;
use App\Entity\Article;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //自定义导航
        $navs=Navs::all();

        //热点文章
        $hotArticles=Article::orderBy('created_at','desc')->take(8)->get();
        //点击排行
        $clickOrder=Article::orderBy('viewCount','desc')->take(5)->get();
        view()->share('navs',$navs);
        view()->share('hotArticles',$hotArticles);
        view()->share('clickOrder',$clickOrder);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

@extends('home.master')
@section('info')
    <title>{{Config::get('webConfig.web_title')}}</title>
    <meta name="keywords" content="{{Config::get('webConfig.web_key')}}" />
    <meta name="description" content="{{Config::get('webConfig.web_description')}}" />
  <link href="/home/css/style.css" rel="stylesheet">
  @endsection
@section('content')
  <article class="blogs">
    <h1 class="t_nav"><span>“慢生活”不是懒惰，放慢速度不是拖延时间，而是让我们在生活中寻找到平衡。</span><a href="/" class="n1">网站首页</a><a href="/" class="n2">{{$cate->name}}</a></h1>
    <div class="newblog left">
      @foreach($articles as $article)
      <h2>{{$article->title}}</h2>
      <p class="dateview"><span>发布时间：{{$article->created_at}}</span><span>作者：{{$article->editor}}</span><span>分类：[<a href="/cate_two/{{$article->cate_id}}">{{$article->cate_name}}</a>]</span><span>点击次数：{{$article->viewCount}}</span></p>
      <figure><img src="/{{$article->thumb}}" style="max-height: 125px"></figure>
      <ul class="nlist">
        <p>{{$article->description}}</p>
        <a title="{{$article->title}}" href="/article/{{$article->id}}" target="_blank" class="readmore">阅读全文>></a>
      </ul>
      <div class="line"></div>
      @endforeach
      <div class="blank"></div>
          <style>
              .page ul{
                  padding-left: 180px;
              }
              .page ul li{
                  float: left;
                  padding: 5px 10px;
                  font-size: 20px;
              }
          </style>
      <div class="page">
          {!! $articles->links() !!}
      </div>
    </div>
    <aside class="right">
      <div class="rnav">
        <ul>
          @foreach($categorys as $category)
          <li class="rnav{{mt_rand(1,4)}}"><a href="/cate_two/{{$category->id}}">{{$category->name}}</a></li>
          @endforeach
        </ul>
      </div>
      <div class="news">
        @parent
      </div>
      {{--<div class="visitors">
        <h3><p>最近访客</p></h3>
        <ul>

        </ul>
      </div>--}}
      <!-- Baidu Button BEGIN -->
      <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
      <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
      <script type="text/javascript" id="bdshell_js"></script>
      <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
      </script>
      <!-- Baidu Button END -->
    </aside>
  </article>
@endsection


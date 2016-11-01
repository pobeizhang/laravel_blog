@extends('home.master')
@section('info')
  <title>{{Config::get('webConfig.web_title')}}</title>
  <meta name="keywords" content="{{Config::get('webConfig.web_key')}}" />
  <meta name="description" content="{{Config::get('webConfig.web_description')}}" />
  <link href="/home/css/new.css" rel="stylesheet">
  @endsection
@section('content')
  <article class="blogs">
    <h1 class="t_nav"><span>您当前的位置：<a href="/">首页</a>@foreach($cates as $cate)&nbsp;&gt;&nbsp;<a href="">{{$cate['name']}}</a>@endforeach&nbsp;&gt;&nbsp;{{$articleContent->title}}</span><a href="/" class="n1">网站首页</a><a href="/" class="n2">文章</a></h1>
    <div class="index_about">
      <h2 class="c_titile">{{$articleContent->title}}</h2>
      <p class="box_c"><span class="d_time">发布时间：{{$articleContent->created_at}}</span><span>编辑：{{$articleContent->editor}}</span><span>点击数：{{$articleContent->viewCount}}</span></p>
      <ul class="infos">
        {!! $articleContent->content !!}
      </ul>
      <div class="keybq">
        <p><span>关键字词</span>：{{$articleContent->key}}</p>

      </div>
      <div class="ad"> </div>
      <div class="nextinfo">
        <p>上一篇：@if($article['pre'])<a href="/article/{{$article['pre']->id}}">{{$article['pre']->title}}</a></p>@else <span>没有上一篇了</span> @endif
        <p>下一篇：@if($article['next'])<a href="/article/{{$article['next']->id}}">{{$article['next']->title}}</a></p>@else <span>没有下一篇了</span> @endif
      </div>
      <div class="otherlink">
        <h2>相关文章</h2>
        <ul>
          @foreach($relevantArticles as $relevantArticle)
          <li><a href="/article/{{$relevantArticle->id}}" title="{{$relevantArticle->title}}">{{$relevantArticle->title}}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
    <aside class="right">
      <!-- Baidu Button BEGIN -->
      <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
      <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
      <script type="text/javascript" id="bdshell_js"></script>
      <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
      </script>
      <!-- Baidu Button END -->
      <div class="blank"></div>
      <div class="news">
        @parent
      </div>

    </aside>
  </article>
@endsection


@extends('home.master')
@section('info')
  <title>{{Config::get('webConfig.web_title')}}</title>
  <meta name="keywords" content="{{Config::get('webConfig.web_key')}}" />
  <meta name="description" content="{{Config::get('webConfig.web_description')}}" />
  <link href="/home/css/index.css" rel="stylesheet">
  <link href="/home/css/share.css" rel="stylesheet">
  @endsection
@section('content')
<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
      <p>加了锁的青春，不会再因谁而推开心门。</p>
    </ul>
    <div class="avatar"><a href="#"><span>杨青</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>站长</span>推荐 recommend</p>
    </h3>
    <ul>
      @foreach($recommends as $r)
      <li>
        <a href="/article/{{$r->id}}"  target="_blank">
          <img src="{{$r->thumb}}">
        </a>
        <span>{{$r->title}}</span>
      </li>
      @endforeach
    </ul>
  </div>
</div>
<article>
  <h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
    @foreach($articles as $k=>$v)
    <h3><a href="/article/{{$v->id}}">{{$v->title}}</a></h3>
    <figure><img src="{{$v->thumb}}" style="max-height: 125px"></figure>
    <ul>
      <p>{{$v->description}}</p>
      <a title="阅读全文" href="/article/{{$v->id}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview">
      <span>{{$v->created_at}}</span>
      <span>作者：{{$v->editor}}</span>
      <span>文章分类：[<a href="/cate_two/{{$v->cid}}">{{$v->cate_name}}</a>]</span>
      <span>点击次数：{{$v->viewCount}}</span>
    </p>
    @endforeach
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
      <h2>文章分类</h2>
      <ul>
        @foreach($topCates as $topCate)
        <li><a href="/category/{{$topCate->id}}" target="_blank">{{$topCate->name}}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="news">
      @parent
      <h3 class="links">
        <p>友情<span>链接</span></p>
      </h3>
      <ul class="website">
        @foreach($links as $l)
        <li>
          <a href="{{$l->url}}" target="_blank" title="{{$l->title}}">{{$l->name}}</a>
        </li>
        @endforeach
      </ul>
    </div>
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
      document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
    <!-- Baidu Button END -->
    <a href="/" class="weixin"> </a>
  </aside>
</article>
@endsection


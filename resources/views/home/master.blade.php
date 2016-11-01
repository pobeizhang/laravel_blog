<!doctype html>
<html>
<head>
  <meta charset="gb2312">
  @yield('info')
  <link href="/home/css/base.css" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="/home/js/modernizr.js"></script>
  <![endif]-->
</head>
<body>
<header>
  <div id="logo"><a href="/"></a></div>
  <nav class="topnav" id="topnav">@foreach($navs as $nav)<a href="{{$nav->url}}"><span>{{$nav->name}}</span><span class="en">{{$nav->alias}}</span></a>@endforeach
  </nav>
  </nav>
</header>
@section('content')
  <h3>
    <p>最新<span>文章</span></p>
  </h3>
  <ul class="rank">
    @foreach($hotArticles as $h)
    <li>
      <a href="/article/{{$h->id}}" title="{{$h->title}}" target="_blank">{{$h->title}}</a>
    </li>
    @endforeach
  </ul>
  <h3 class="ph">
    <p>点击<span>排行</span></p>
  </h3>
  <ul class="paih">
    @foreach($clickOrder as $c)
    <li>
      <a href="/article/{{$c->id}}" title="{{$c->title}}" target="_blank">{{$c->title}}</a>
    </li>
   @endforeach
  </ul>
  @show
<footer>
  <p>杜磊&nbsp;版权所有&nbsp;<a href="http://www.miitbeian.gov.cn/" target="_blank">{{Config::get('webConfig.web_copyright')}}</a></p>
</footer>
</body>
</html>
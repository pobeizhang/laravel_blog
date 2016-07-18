@extends('admin.master')

@section('title','后台首页')


@section('content')
<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">后台管理模板</div>
			<ul>
				<li><a href="/" class="active">首页</a></li>
				<li><a href="/admin/info" target="main">管理页</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理员：@if(isset($admin_username)){{$admin_username}}@endif</li>
				<li><a href="/admin/pass" target="main">修改密码</a></li>
				<li><a href="/admin/loginout">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>内容管理</h3>
                <ul class="sub_menu">
                    <li><a href="/admin/toCategoryAdd" target="main"><i class="fa fa-fw fa-plus-square"></i>添加分类</a></li>
                    <li><a href="/admin/toCategoryList" target="main"><i class="fa fa-fw fa-list-ul"></i>分类列表</a></li>
                    <li><a href="/admin/toArticleAdd" target="main"><i class="fa fa-fw fa-list-alt"></i>添加文章</a></li>
					<li><a href="/admin/toArticleList" target="main"><i class="fa fa-fw fa-list-ul"></i>文章列表</a></li>
                    {{--<li><a href="img.html" target="main"><i class="fa fa-fw fa-image"></i>图片列表</a></li>--}}
                </ul>
            </li>
			<li>
				<h3><i class="fa fa-fw fa-send"></i>友情链接</h3>
				<ul class="sub_menu">
					<li><a href="/admin/toFriendLinksAdd" target="main"><i class="fa fa-fw fa-plus-square"></i>添加友情链接</a></li>
					<li><a href="/admin/toFriendLinksList" target="main"><i class="fa fa-fw fa-list-ul"></i>友情链接列表</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-navicon"></i>自定义导航</h3>
				<ul class="sub_menu">
					<li><a href="/admin/toNavsAdd" target="main"><i class="fa fa-fw fa-plus-square"></i>添加自定义导航</a></li>
					<li><a href="/admin/toNavsList" target="main"><i class="fa fa-fw fa-list-ul"></i>自定义导航列表</a></li>
				</ul>
			</li>
            <li>
            	<h3><i class="fa fa-fw fa-cubes"></i>网站配置</h3>
                <ul class="sub_menu">
                    <li><a href="/admin/toConfigAdd" target="main"><i class="fa fa-fw fa-plus-square"></i>添加网站配置</a></li>
                    <li><a href="/admin/toConfigList" target="main"><i class="fa fa-fw fa-list-ul"></i>网站配置列表</a></li>
                    <li><a href="#" target="main"><i class="fa fa-fw fa-database"></i>备份还原</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>
                <ul class="sub_menu">
                    <li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>图标调用</a></li>
                    <li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>
                    <li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>
                    <li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他组件</a></li>
                </ul>
            </li>
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="/admin/info" frameborder="0" width="100%" height="100%" name="main"></iframe> 
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2015. Powered By <a href="http://www.dlzhangyy.com">http://www.dlzhangyy.com</a>.
	</div>
	<!--底部 结束-->
@endsection

@section('my-js')

@endsection

@extends('admin.master')
@section('title','修改自定义导航页面')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="/admin/info">首页</a> &raquo;修改自定义导航
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="/admin/info"><i class="fa fa-plus"></i>后台首页</a>
                <a href="/admin/toNavsAdd"><i class="fa fa-recycle"></i>添加自定义导航</a>
                <a href="/admin/toNavsList"><i class="fa fa-recycle"></i>自定义导航列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <table class="add_tab">
            <tbody>
                <tr>
                    <th><i class="require">*</i>自定义导航名称：</th>
                    <td>
                        <input type="text" name="name" value="{{$navs->name}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>自定义导航别称：</th>
                    <td>
                        <input type="text" name="alias" value="{{$navs->alias}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>自定义导航地址：</th>
                    <td>
                        <input type="text"  class="lg" name="url" value="{{$navs->url}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>自定义导航排序：</th>
                    <td>
                        <input type="text" name="order" value="{{$navs->order}}">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" onclick="navsEdit({{$navs->id}});" value="修改">
                        <input type="button" class="back" onclick="history.go(-1)" value="取消">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('my-js')
    <script>
        function navsEdit(id){
            var name=$('input[name=name]').val();
            var alias=$('input[name=alias]').val();
            var url=$('input[name=url]').val();
            var order=$('input[name=order]').val();
            if(name == ''){
                layer.alert('请填写自定义导航名称', {icon: 5});
                return;
            }
            if(alias == ''){
                layer.alert('请填写自定义导航别称', {icon: 5});
                return;
            }
            if(url == ''){
                layer.alert('请填写自定义导航地址', {icon: 5});
                return;
            }
            if(order == ''){
                layer.alert('请填写自定义导航排序', {icon: 5});
                return;
            }
            $.ajax({
                url:'/admin/service/navsEdit',
                type:'post',
                dataType:'json',
                cache:false,
                data:{id:id,name:name,alias:alias,url:url,order:order,_token:"{{csrf_token()}}"},
                success:function(data){
                    if(data == null){
                        layer.alert('服务端出现错误', {icon: 5});
                        return;
                    }
                    if(data.status != 0){
                        layer.alert(data.message, {icon: 5});
                        return;
                    }
                    layer.alert(data.message, {icon: 6});
                    location.href="/admin/toNavsList";
                    return;
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    </script>
@endsection
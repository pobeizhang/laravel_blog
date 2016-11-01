@extends('admin.master')
@section('title','添加分类页面')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="/admin/info">首页</a> &raquo;添加分类
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="/admin/toArticleAdd"><i class="fa fa-plus"></i>新增文章</a>
                <a href="/admin/toCategoryList"><i class="fa fa-list-ul"></i>分类列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <table class="add_tab">
            <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>所属分类：</th>
                    <td>
                        <select name="pid">
                            <option value="0">==顶级分类==</option>
                            @foreach($categorys as $k=>$v)
                            <option value="{{$v->id}}">{{$v->_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类名称：</th>
                    <td>
                        <input type="text" name="name">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类标题：</th>
                    <td>
                        <input type="text" class="lg" name="title">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>关键词：</th>
                    <td>
                        <textarea name="key"></textarea>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>描述：</th>
                    <td>
                        <textarea name="description"></textarea>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" class="sm" name="order">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" onclick="cateAdd();" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('my-js')
    <script>
        function cateAdd(){
            pid=$('select option:selected').val();
            name=$('input[name=name]').val();
            title=$('input[name=title]').val();
            key=$('textarea[name=key]').val();
            description=$('textarea[name=description]').val();
            order=$('input[name=order]').val()
            if(name == ''){
                layer.alert('请填写分类名称', {icon: 5});
                return;
            }
            if(title == ''){
                layer.alert('请填写分类标题', {icon: 5});
                return;
            }
            if(key == ''){
                layer.alert('请填写分类关键词', {icon: 5});
                return;
            }
            if(description == ''){
                layer.alert('请填写分类描述', {icon: 5});
                return;
            }
            if(order == ''){
                layer.alert('请填写分类排序序号', {icon: 5});
                return;
            }
            if(isNaN(order)){
                layer.alert('分类排序序号必须是数字', {icon: 5});
                return;
            }
            $.ajax({
                url:'/admin/service/cateAdd',
                type:'post',
                dataType:'json',
                cache:false,
                data:{pid:pid,name:name,title:title,key:key,description:description,order:order,_token:"{{csrf_token()}}"},
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
                    location.href="/admin/toCategoryList";
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

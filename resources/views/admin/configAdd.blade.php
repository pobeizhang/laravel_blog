@extends('admin.master')
@section('title','添加配置项页面')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="/admin/info">首页</a> &raquo;添加配置项
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
                <a href="/admin/toConfigList"><i class="fa fa-recycle"></i>配置项列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <table class="add_tab">
            <tbody>
                <tr>
                    <th><i class="require">*</i>配置项标题：</th>
                    <td>
                        <input type="text" name="title">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>配置项名称：</th>
                    <td>
                        <input type="text" name="name">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>类型：</th>
                    <td>
                        <input type="radio" name="type" checked value="input" onclick="showValue()">input&nbsp;&nbsp;
                        <input type="radio" name="type" value="textarea" onclick="showValue()">textarea&nbsp;&nbsp;
                        <input type="radio" name="type" value="radio" onclick="showValue()">radio&nbsp;&nbsp;
                        <span><i class="fa fa-exclamation-circle yellow"></i>类型:input、textarea、radio</span>
                    </td>
                </tr>
                <tr class="showValue">
                    <th>类型值：</th>
                    <td>
                        <input type="text" class="lg"  name="value">
                        <p><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio的情况下才需要配置:格式 1|开启,0|关闭</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" class="sm" name="order" value="0">
                    </td>
                </tr>
                <tr>
                    <th>备注：</th>
                    <td>
                        <textarea name="tips" cols="30" rows="10"></textarea>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" onclick="configAdd();" value="添加">
                        <input type="button" class="back" onclick="history.go(-1)" value="取消">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('my-js')
    <script>
        function configAdd(){
            var title=$('input[name=title]').val();
            var name=$('input[name=name]').val();
            var type=$('input[name=type]:checked').val();
            var value=$('input[name=value]').val();
            var order=$('input[name=order]').val();
            var tips=$('textarea[name=tips]').val();
            if(title == ''){
                layer.alert('请填写配置项标题', {icon: 5});
                return;
            }
            if(name == ''){
                layer.alert('请填写配置项名称', {icon: 5});
                return;
            }
            if(type == ''){
                layer.alert('请填写类型', {icon: 5});
                return;
            }
            if(order == ''){
                layer.alert('请填写排序', {icon: 5});
                return;
            }

            $.ajax({
                url:'/admin/service/configAdd',
                type:'post',
                dataType:'json',
                cache:false,
                data:{title:title,name:name,type:type,value:value,order:order,tips:tips,_token:"{{csrf_token()}}"},
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
                    location.href="/admin/toConfigList";
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
    <script>
        showValue();
        function showValue(){
            var value=$('input[name=type]:checked').val();
            if(value == 'radio'){
                $('.showValue').show();
            }else{
                $('.showValue').hide();
            }
        }
    </script>
@endsection
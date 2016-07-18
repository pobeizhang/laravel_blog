@extends('admin.master')
@section('title','自定义导航列表页')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="/admin/info">首页</a> &raquo;自定义导航列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    {{--<form action="#" method="post">--}}
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="/admin/info"><i class="fa fa-plus"></i>后台首页</a>
                    <a href="/admin/toNavsAdd"><i class="fa fa-refresh"></i>添加自定义导航</a>
                    <a href="javascript:;" onclick="navsDel();"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="/admin/toNavsList"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">
                            <input type="checkbox" name="delAll">
                        </th>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>名称</th>
                        <th>别称</th>
                        <th>链接地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($navs as $k=>$v)
                    <tr>
                        <td class="tc">
                            <input type="checkbox" name="id" value="{{$v->id}}">
                        </td>
                        <td class="tc">
                            <input type="text" name="order[]" onchange="changeOrder(this,{{$v->id}});" value="{{$v->order}}">
                        </td>
                        <td class="tc">{{$v->id}}</td>
                        <td>
                            <a href="#">{{$v->name}}</a>
                        </td>
                        <td>{{$v->alias}}</td>
                        <td>{{$v->url}}</td>
                        <td>
                            <a href="/admin/toNavsEdit/{{$v->id}}">修改</a>
                            <a href="javascript:;" onclick="navDel({{$v->id}});">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    {{--</form>--}}
    <!--搜索结果页面 列表 结束-->
@endsection

@section('my-js')
    <script>
        //排序函数
        function changeOrder(obj,id){
            var order=$(obj).val();
            $.ajax({
                type:'post',
                url:'/admin/service/navsOrder',
                dataType:'json',
                cache:false,
                data:{id:id,order:order,_token:"{{csrf_token()}}"},
                success:function(data){
                    if(data == null){
                        layer.alert('服务端错误', {icon: 5});
                        return;
                    }
                    if(data.status != 0){
                        layer.alert(data.message, {icon: 5});
                        return;
                    }
//                    layer.alert(data.message, {icon: 6});

                },
                error:function(xhr,status,error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
        //单个删除分类函数
        function navDel(id){
            var id=id;
            layer.msg('确定删除该自定义导航吗？', {
                time: 0, //不自动关闭
                btn: ['确定', '取消'],
                yes: function(index){

                    $.ajax({
                        url:'/admin/service/navDel',
                        type:'post',
                        dataType:'json',
                        cache:false,
                        data:{id:id,_token:"{{csrf_token()}}"},
                        success:function(data){
                            if(data == null){
                                layer.alert('服务端出错', {icon: 5});
                                return;
                            }
                            if(data.status !=0){
                                layer.alert(data.message, {icon: 5});
                                return;
                            }

                            location.href="/admin/toNavsList";
                        },
                        error:function(xhr,status,error){
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                        }
                    });
                }
            });
        }

        //批量删除分类
        function navsDel(){
            layer.msg('确定删除选中的这些导航吗？', {
                time: 0, //不自动关闭
                btn: ['确定', '取消'],
                yes: function(index){
                    var ids=$('input[name=id]');
                    var str=[];
//            var str='';
                    for(var i=0;i<ids.length;i++){
                        if(ids[i].checked){
//                    str+=ids[i].value+',';
                            str.push(ids[i].value);
                        }

                    }
//            console.log(str);
                    $.ajax({
                        url:'/admin/service/navsDel',
                        type:'post',
                        dataType:'json',
                        cache:false,
                        data:{ids:str,_token:"{{csrf_token()}}"},
                        success:function(data){
                            if(data == null){
                                layer.alert('服务端出错', {icon: 5});
                                return;
                            }
                            if(data.status !=0){
                                layer.alert(data.message, {icon: 5});
                                return;
                            }

                            location.href="/admin/toNavsList";

                        },
                        error:function(xhr,status,error){
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                        }
                    });
                }
            });

        }

    </script>
@endsection

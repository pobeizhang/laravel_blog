@extends('admin.master')
@section('title','友情链接列表页')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="/admin/info">首页</a> &raquo;友情链接列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    {{--<form action="#" method="post">--}}
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="/admin/info"><i class="fa fa-plus"></i>后台首页</a>
                    <a href="/admin/tofriendLinksList"><i class="fa fa-refresh"></i>添加友情链接</a>
                    <a href="javascript:;" onclick="friendLinksDel();"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="/admin/toFriendLinksList"><i class="fa fa-refresh"></i>更新排序</a>
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
                        <th>简介</th>
                        <th>链接地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($friendLinks as $k=>$v)
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
                        <td>{{$v->title}}</td>
                        <td>{{$v->url}}</td>
                        <td>
                            <a href="/admin/toFriendLinksEdit/{{$v->id}}">修改</a>
                            <a href="javascript:;" onclick="friendLinkDel({{$v->id}});">删除</a>
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
                url:'/admin/service/friendLinksOrder',
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
        function friendLinkDel(id){
            var id=id;
            layer.msg('确定删除该友情链接吗？', {
                time: 0, //不自动关闭
                btn: ['确定', '取消'],
                yes: function(index){

                    $.ajax({
                        url:'/admin/service/friendLinkDel',
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

                            location.href="/admin/toFriendLinksList";
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
        function friendLinksDel(){
            layer.msg('确定删除选中的这些友情链接吗？', {
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
                        url:'/admin/service/friendLinksDel',
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

                            location.href="/admin/toFriendLinksList";

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

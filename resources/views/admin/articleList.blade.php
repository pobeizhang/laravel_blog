@extends('admin.master')
@section('title','文章列表页')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="/admin/info">首页</a> &raquo;文章列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    {{--<form action="#" method="post">--}}
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="/admin/toArticleAdd"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="javascript:;" onclick="articlesDel();"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="/admin/toArticleList"><i class="fa fa-refresh"></i>全部文章</a>
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
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>作者</th>
                        <th>缩略图</th>
                        <th>类别</th>
                        <th>点击</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($articles as $k=>$article)
                    <tr>
                        <td class="tc">
                            <input type="checkbox" name="id" value="{{$article->id}}">
                        </td>
                        <td class="tc">{{$article->id}}</td>
                        <td>
                            <a href="#">{{$article->title}}</a>
                        </td>
                        <td>{{$article->editor}}</td>
                        <td>
                            <img height="50" src="/{{$article->thumb}}" alt="">
                        </td>
                        <td>{{$article->name}}</td>

                        <td>{{$article->viewCount}}</td>
                        <td>{{$article->created_at}}</td>
                        <td>
                            <a href="/admin/toArticleEdit/{{$article->id}}">修改</a>
                            <a href="javascript:;" onclick="articleDel({{$article->id}});">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <style>
                    .page_list ul li span {
                        padding: 6px 12px;
                        text-decoration: none;
                    }
                </style>
                <div class="page_list">
                    {!! $articles->links() !!}
                </div>

            </div>
        </div>
    {{--</form>--}}
    <!--搜索结果页面 列表 结束-->
@endsection

@section('my-js')
    {{--单个删除文章--}}
    <script>
        function articleDel(id){
            layer.msg('确定删除该文章吗？', {
                time: 0, //不自动关闭
                btn: ['确定', '取消'],
                yes: function(index){
                    $.ajax({
                        url:'/admin/service/articleDel',
                        type:'post',
                        cache:false,
                        dataType:'json',
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
                            location.href="/admin/toArticleList";

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

        //批量删除
        function articlesDel(){
            layer.msg('确定删除选中的这些文章吗？', {
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
                        url:'/admin/service/articlesDel',
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

                            location.href="/admin/toArticleList";

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

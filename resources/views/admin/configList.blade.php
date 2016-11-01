@extends('admin.master')
@section('title','配置项列表页')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="/admin/info">首页</a> &raquo;配置项列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="/admin/info"><i class="fa fa-plus"></i>后台首页</a>
                    <a href="/admin/toConfigAdd"><i class="fa fa-refresh"></i>添加配置项</a>
                    <a href="/admin/toConfigList"><i class="fa fa-refresh"></i>更新排序</a>
                    <a href="javascript:;" id="configContentEdit"><i class="fa fa-refresh"></i>修改配置项的内容</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>
    <form id="configForm">
        {{csrf_field()}}
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                       {{-- <th class="tc" width="5%">
                            <input type="checkbox" name="delAll">
                        </th>--}}
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>名称</th>
                        <th>内容</th>
                        <th>操作</th>
                    </tr>
                    @foreach($configs as $k=>$v)
                    <tr>
                        {{--<td class="tc">
                            <input type="checkbox" name="id[]" value="{{$v->id}}">
                        </td>--}}
                        <td class="tc">
                            <input type="text" name="order[]" onchange="changeOrder(this,{{$v->id}});" value="{{$v->order}}">
                        </td>
                        <td class="tc">{{$v->id}}<input type="hidden" name="ids[]" value="{{$v->id}}"></td>
                        <td>
                            <a href="#">{{$v->title}}</a>
                        </td>
                        <td>{{$v->name}}</td>
                        <td>{!! $v->_html !!}</td>
                        <td>
                            <a href="/admin/toConfigEdit/{{$v->id}}">修改</a>
                            <a href="javascript:;" onclick="configDel({{$v->id}});">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection

@section('my-js')
    <script>
        //排序函数
        function changeOrder(obj,id){
            var order=$(obj).val();
            $.ajax({
                type:'post',
                url:'/admin/service/configOrder',
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
        function configDel(id){
            var id=id;
            layer.msg('确定删除该配置项吗？', {
                time: 0, //不自动关闭
                btn: ['确定', '取消'],
                yes: function(index){

                    $.ajax({
                        url:'/admin/service/configDel',
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

                            location.href="/admin/toConfigList";
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

    {{--修改配置项的内容--}}
    <script>

        $('#configContentEdit').on('click',function(){
            $('#configForm').ajaxSubmit({
                url:'/admin/service/configContentEdit',
                dataType:'json',
                type:'post',
                success:function(data){
                    if(data == null){
                        layer.alert('服务端出错', {icon: 5});
                        return;
                    }

                    layer.msg(data.message, {icon: 6});
                    setTimeout(function(){
                        location.href="/admin/toConfigList";
                    },800);

                }
            });
        });

    </script>
@endsection

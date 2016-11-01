@extends('admin.master')
@section('title','修改文章页面')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="/admin/info">首页</a> &raquo;修改文章
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
                <a href="#"><i class="fa fa-recycle"></i>文章列表</a>
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
                        <select name="cid">
                            @foreach($categorys as $k=>$v)
                                <option value="{{$v->id}}" @if($v->id == $article->cid) selected @endif>{{$v->_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章标题：</th>
                    <td>
                        <input type="text" class="lg" name="title" value="{{$article->title}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>作者：</th>
                    <td>
                        <input type="text" name="editor" value="{{$article->editor}}">
                    </td>
                </tr>

                <tr>
                    {{--这个js文件必须放在文本前面--}}
                    <script src="/uploadify/jquery.1.7.1.min.js" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="/uploadify/uploadify.css">
                    <style>
                        .uploadify{display:inline-block;}
                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                    </style>
                    <th><i class="require">*</i>缩略图：</th>
                    <td>
                        <input type="text" disabled name="thumb" value="{{$article->thumb}}">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                    </td>
                    <script type="text/javascript">
                        <?php $timestamp = time();?>
                        $(function() {
                            $('#file_upload').uploadify({
                                'buttonText' : '缩略图上传',
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    '_token'     : "{{csrf_token()}}"
                                },
                                'swf'      : '/uploadify/uploadify.swf',
                                'uploader' : '/admin/service/uploadThumb',
                                'onUploadSuccess' : function(file, data, response) {
                                    $('input[name=thumb]').val(data);
                                    $('#thumb_preview').attr('src','/'+data);
                                }
                            });
                        });
                    </script>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="/{{$article->thumb}}" id="thumb_preview" style="max-width: 350px;max-height: 100px;">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章关键词：</th>
                    <td>
                        <textarea name="key">{{$article->key}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章描述：</th>
                    <td>
                        <textarea name="description">{{$article->description}}</textarea>
                    </td>
                </tr>
                <tr>

                    <th>详细内容：</th>
                    <td>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>
                        <script id="editor" name="content" type="text/plain" style="width:860px;height:300px;">{!! $article->content !!}</script>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" onclick="articleEdit({{$article->id}});" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('my-js')
    {{--uediotor相关的js文件--}}
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script>
        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');
    </script>

    {{--uploadify相关文件--}}
    <script src="/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

    <script>
        function articleEdit(id){
            var cid=$('select option:selected').val();
            var title=$('input[name=title]').val();
            var editor=$('input[name=editor]').val();
            var thumb=$('input[name=thumb]').val();
            var key=$('textarea[name=key]').val();
            var description=$('textarea[name=description]').val();
            var content=ue.getContent();
            if(title == ''){
                layer.alert('请填写文章标题', {icon: 5});
                return;
            }
            if(editor == ''){
                layer.alert('请填写文章作者', {icon: 5});
                return;
            }
            if(thumb == ''){
                layer.alert('请上传文章缩略图', {icon: 5});
                return;
            }
            if(key == ''){
                layer.alert('请填写文章关键词', {icon: 5});
                return;
            }
            if(description == ''){
                layer.alert('请填写文章描述', {icon: 5});
                return;
            }
            if(content == ''){
                layer.alert('请填写文章内容', {icon: 5});
                return;
            }
            $.ajax({
                url:'/admin/service/articleEdit',
                type:'post',
                dataType:'json',
                cache:false,
                data:{id:id,cid:cid,title:title,editor:editor,thumb:thumb,key:key,description:description,content:content,_token:"{{csrf_token()}}"},
                success:function(data){
                    if(data == null){
                        layer.alert('服务器端出错', {icon: 5});
                        return;
                    }
                    if(data.status != 0){
                        layer.alert(data.message, {icon: 5});
                        return;
                    }
                    layer.alert(data.message, {icon: 6});
                    location.href="/admin/toArticleList";
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
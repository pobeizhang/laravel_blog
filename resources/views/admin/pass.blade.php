@extends('admin.master')

@section('title','修改密码')

@section('content')
    <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 修改密码
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>修改密码</h3>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <!--<form method="post" onsubmit="return changePass()" action="/admin/service/pass">-->
        <table class="add_tab">
        	<!--{{csrf_field()}}-->
            <tbody>
            	<tr>
            		<th></th>
            		<td>
            			<p style="font-weight: bold;font-size: 20px;color: red;" id='pass_error'></p>
            		</td>
            	</tr>
            <tr>
                <th width="120">
                	<i class="require">*</i>原密码：
                </th>
                <td>
                    <input type="password" name="password_o">
                    <span>请输入原始密码</span>
                </td>
            </tr>
            <tr>
                <th>
                	<i class="require">*</i>新密码：
                </th>
                <td>
                    <input type="password" name="password">
                    <span>新密码6-20位</span>
                </td>
            </tr>
            <tr>
                <th>
                	<i class="require">*</i>确认密码：
                </th>
                <td>
                    <input type="password" name="password_c">
                    <span>再次输入密码</span>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" onclick="onPassClick();" value="确认">
                    <input type="button" class="back" onclick="history.go(-1)" value="取消">
                </td>
            </tr>
            </tbody>
        </table>
    <!--</form>-->
</div>
@endsection

@section('my-js')
<script type="text/javascript">

	function onPassClick(){
		var password_o=$('input[name=password_o]').val();
		var password=$('input[name=password]').val();
		var password_c=$('input[name=password_c]').val();
		if(password_o == ''){
			$('#pass_error').html('请填写要修改的密码');
			return;
		}else{
			$('#pass_error').html('');
		}
		if(password == ''){
			$('#pass_error').html('请填写你的新密码');
			return;
		}else{
			$('#pass_error').html('');
		}
		if(password.length<6 || password.length>20){
			$('#pass_error').html('密码必须是6到20位之间的字符');
			return;
		}
		if(password_c == ''){
			$('#pass_error').html('请再次填写你的新密码');
			return;
		}else{
			$('#pass_error').html('');
		}
		$.ajax({
			type:"post",
			url:"/admin/service/member/changPass",
			cache:false,
			dataType:'json',
			data:{password_o:password_o,password:password,password_c:password_c,_token:'{{csrf_token()}}'},
			success:function(date){
				if(date == null){
					$('#pass_error').html('服务器端出错!!!');
					return false;
				}
//				console.log(date);
				if(date.status != 0){
					$('#pass_error').html(date.message);
					return false;
				}
				
				$('#pass_error').html('密码修改成功');
				$('#pass_error').css({'color':'green'});
				location.href="/admin/info";
				
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

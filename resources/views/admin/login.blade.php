@extends('admin.master')

@section('title','后台登录页面')
@section('content')
    <div class="login_box">
        <h1>Blog</h1>
        <h2>欢迎使用博客管理平台</h2>
        <div class="form">
            <p style="color:red" id='tishi'></p>
            <!--<form action="#" method="post">-->

                <ul>
                    <li>
                        <input type="text" name="username" class="text"/>
                        <span><i class="fa fa-user"></i></span>
                    </li>
                    <li>
                        <input type="password" name="password" class="text"/>
                        <span><i class="fa fa-lock"></i></span>
                    </li>
                    <li>
                        <input type="text" class="code" name="code"/>
                        <span><i class="fa fa-check-square-o"></i></span>
                        <img src="/admin/service/validate_code/create" alt="" class="validate_code">
                    </li>
                    <li>
                        <input type="submit" onclick="onLoginClick();" value="立即登陆"/>
                    </li>
                </ul>
            <!--</form>-->
            <p><a href="/">返回首页</a> &copy; <a href="http://www.miitbeian.gov.cn/" target="_blank">{{Config::get('webConfig.web_copyright')}}</a></p>
        </div>
    </div>
    @endsection
@section('my-js')
	<!--验证码的点击切换-->
    <script>
        $('.validate_code').click(function(){
            $(this).attr('src','/admin/service/validate_code/create?code='+Math.random());
        });
    </script>
    <!--登录-->
    <script type="text/javascript">
    	function onLoginClick(){
    		var username=$('input[name=username]').val();
    		var password=$('input[name=password]').val();
    		var code=$('input[name=code]').val();
    		$.ajax({
    			type:"post",
    			dataType:'json',
    			url:"/admin/service/member",
    			cache:false,
    			data:{username:username,password:password,code:code,_token:'{{csrf_token()}}'},
    			success:function(data){
//					console.log(data.status);
					if(data==null){
						$('#tishi').html('服务端出错');
						return;
					}

					if(data.status != 0){
//						console.log(data.message);
						$('#tishi').html(data.message);
						return; 
					}
					
					$('#tishi').html('欢迎登陆后台');
					location.href="/admin/index";
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

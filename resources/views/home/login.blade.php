 @extends('home.layout')
 @section('banner')
 <script type="text/javascript">
    document.title='康复社-用户登录';

</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
<link rel="stylesheet" href="{{ url('/home/css/login.css') }}">
<!-- 内容开始 -->
	<div id="login">
		<div class="login">
			<div class="bg"></div>
			<form action="{{ url('/home/dologin') }}" method="post">
			 {{ csrf_field() }}
				<dl>
					<dt>
						<p>
							<span class="title">用户登录</span>
							<span class="right">
								还没有帐号？ 去<a href="###">注册</a>
							</span>
						</p>
					</dt>
					<div style="clear: both;"></div>
					 @if(session('info'))
        			
               			<script type="text/javascript">
               			alert('身份未选择');
               				
               			</script>
            		
            
        			@endif
        			 @if(session('mm'))
        			
               			<script type="text/javascript">
               			alert('密码错误');
               				
               			</script>
            		
            
        			@endif
        			 @if(session('sf'))
        			
               			<script type="text/javascript">
               			alert('身份不匹配');
               				
               			</script>
            		
            
        			@endif
        			 @if(session('zh'))
        			
               			<script type="text/javascript">
               			alert('密码错误');
               				
               			</script>
            		
            
        			@endif
        			@if(session('yz'))
        			<script type="text/javascript">
               			alert('验证码不正确');
               				
               			</script>
            		
            
        			@endif
			        @if (count($errors) > 0)
			            <div class="alert alert-danger">
			                <ul>
			                    @foreach ($errors->all() as $error)
			                        <li style="color: red;">{{ $error }}</li>
			                    @endforeach
			                </ul>
			            </div>
			        @endif
					<dd>
						<span class="title">身　份：</span>
						<select name="utp" id="">
							<option value="0">请选择身份</option>
							<option value="1">患者</option>
							<option value="2">专家</option>
							<option value="3">企业</option>
						</select>
					</dd>
					<dd>
						<span class="title">手机号：</span>
						<input type="text" name ='phone'>
					</dd>
					<dd>
						<span class="title">密　码：</span>
						<input type="password" style="font-size: 14px;height: 40px;line-height:40px;" name ='upwd'>
					</dd>
					<div id="yzm">

						<dd class="yzm">
							<span class="title">验证码：</span>
							<input type="text" name ="captcha">

						</dd>
						<a onclick="javascript:re_captcha();" >
                        	<img src="{{ URL('kit/captcha/1') }}"  alt="验证码" title="刷新图片" width="115" height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
                    		</a>
                    		
                    	<script>  
                        function re_captcha()
                        {
                            $url = "{{ URL('kit/captcha') }}";
                            $url = $url + "/" + Math.random();
                            document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
                        }
                    	</script>
                	
					</div>
					<p>
						<label for="remember">
							<input type="checkbox" id="remember">自动登录
						</label>　
						<a href="#">忘记密码</a>
					</p>
					<input type="submit" value="登　录" />
				</dl>
			</form>
		</div>
	</div>

	<!-- 脚部 -->
@endsection
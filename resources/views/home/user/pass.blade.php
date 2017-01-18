@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-修改密码';
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
@if(session('pass'))
	<script type="text/javascript">
		alert('密码修改成功');
	</script>
@endif
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">


<div class="headTitle">修改密码</div>

<div class="pass">
	<form class="layui-form" action="{{ url('/home/user/passedit')}}" method="post">
	{{ csrf_field() }}
		<div class="layui-form-item">
			<label class="layui-form-label">原始密码</label>
			<div class="layui-input-inline">
				<input type="password" name="password" required lay-verify="required" placeholder="请输入原始密码" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">新密码</label>
			<div class="layui-input-inline">
				<input type="password" name="newpassword" required lay-verify="required" placeholder="请输入新密码" autocomplete="off" class="layui-input">
			</div>
			<div class="layui-form-mid layui-word-aux">密码必须6到12位，且不能出现空格</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">密码验证</label>
			<div class="layui-input-inline">
				<input type="password" name="pass" required lay-verify="required" placeholder="请输入密码验证" autocomplete="off" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit lay-filter="">提交</button>
			</div>
		</div>
	</form>
</div>
</div>
@endsection


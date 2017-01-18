@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-提现操作';
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
@if(session('tx'))
<script type="text/javascript">
		alert('提现金额不能大于账户余额');
</script>
@endif
@if(session('txd'))
<script type="text/javascript">
		alert('提现订单创建失败');
</script>
@endif

<div class="headTitle">提现操作</div>
	

<div class="pass">
<div class="layui-input-inline">账户余额:￥{{$price}}</div>
	<form class="layui-form" action="{{ url('/assets/drawadd')}}" method="post">
	{{ csrf_field() }}
		<div class="layui-form-item">
			<label class="layui-form-label">提现金额</label>
			<div class="layui-input-inline">
				<input type="text" name="draw" required lay-verify="required" placeholder="请输入要提现的金额" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">银行卡号</label>
			<div class="layui-input-inline">
				<input type="text" name="banknum" required lay-verify="required" placeholder="请输入要提现的银行卡号" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">备注</label>
			<div class="layui-input-inline">
				<textarea name="remark"></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit lay-filter="">提现</button>
			</div>
		</div>
	</form>
</div>
</div>
@endsection


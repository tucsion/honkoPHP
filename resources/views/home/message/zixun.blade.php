@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-商品订单';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">

<div class="headTitle">专家回复</div>
<div class="message">
	<ul class="expert">
		<li class="transition">
			<p class="head">
				病历：<a href="#">程序员洁癖晚期(<small>病历编号：1231231</small>)</a> 
				专家：张三疯 <span class="time">2016-12-12 12:10:10</span>
				<button class="layui-btn layui-btn-mini layui-btn-danger newIcon">NEW</button>
			</p>
			<p class="content">
				君有疾在腠理,不治将恐深。
			</p>
			<p class="showBtn"><button class="layui-btn layui-btn-primary layui-btn-mini">查看详情 <i class="layui-icon">&#xe602;</i></button></p>
		</li>
		<li class="transition">
			<p class="head">
				病历：<a href="#">程序员洁癖晚期(<small>病历编号：1231231</small>)</a> 专家：张三疯 <span class="time">2016-12-12 12:10:10</span>
			</p>
			<p class="content">
				君有疾在腠理,不治将恐深。
			</p>
			<p class="showBtn"><button class="layui-btn layui-btn-primary layui-btn-mini">查看详情 <i class="layui-icon">&#xe602;</i></button></p>
		</li>
		<li class="transition">
			<p class="head">
				病历：<a href="#">程序员洁癖晚期(<small>病历编号：1231231</small>)</a> 专家：张三疯 <span class="time">2016-12-12 12:10:10</span>
			</p>
			<p class="content">
				君有疾在腠理,不治将恐深。
			</p>
			<p class="showBtn"><button class="layui-btn layui-btn-primary layui-btn-mini">查看详情 <i class="layui-icon">&#xe602;</i></button></p>
		</li>
		
		
	</ul>
	<div class="page"></div>
	<form action="">
			<div class="message">
			<ul class="expert">
			
			<li class="transition">
			<p class="head">立即咨询专家</p>
			<p class="head">
				病历选择：
					@if(empty($bl))
					<select name="bl"  id='bl'>
						<option value="0" >还没有添加病历</option>
					</select>
					@endif
					@if(!empty($bl))
					<select name="bl"  id='bl'>
						<option value="" >请选择病历</option>
						@foreach($bl as $bingli)
						<option value="{{$bingli -> id}}" >{{$bingli -> dname}}</option>
						@endforeach
					</select>
					@endif
					
				专家：张三疯 <span class="time">2016-12-12 12:10:10</span>
				<button class="layui-btn layui-btn-mini layui-btn-danger newIcon">NEW</button>
			</p>
			<p class="content">
				君有疾在腠理,不治将恐深。
			</p>
			<p class="showBtn"><button class="layui-btn layui-btn-primary layui-btn-mini">咨询 <i class="layui-icon">&#xe602;</i></button></p>
		</li>
			</ul>
		</div>
		</form>
</div>
</div>
	<script src="{{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<script type="text/javascript">
	$('.delBtn').on('click', function() {
		//询问框
		layer.confirm('您真的要删除吗？', {
			btn: ['删除','取消'] //按钮
		}, function(){
			layer.msg('删除成功');
		});
	});
	
	//查看消息
	$('ul.business li a').on('click', function() {
		var thisA = $(this);
		$.post('message_business_layer.html', {}, function(str) {
			layer.open({
				type: 1,
				title : '交易提醒',
				shade : [0.3,'#000'],
				shadeClose : false,
				scrollbar : false,
				area: ['500px', '200px'],
				content: str, //注意，如果str是object，那么需要字符拼接
				cancel :function(){
					thisA.siblings('button').remove();
				}
			});
		});
	});


</script>

@endsection
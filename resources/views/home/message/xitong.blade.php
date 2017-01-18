@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-系统消息';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<div class="headTitle">系统消息</div>
<div class="message">
	<ul class="system">
	@foreach($xitong as $xt)
		<li>
			<div class="left">
				<i class="layui-icon">&#xe623;</i>
				<a href="javascript:void(0);" id="{{ $xt -> id}}">{{$xt -> wname}}</a>
				@if($xt -> wstate == 0)
				<button class="layui-btn layui-btn-mini layui-btn-danger newIcon del">NEW</button>
				@endif
			</div>
			<div class="right">
				<span class="titme">{{ date('Y-m-d H:i:s',$xt -> wtime)}}</span>
			</div>
		</li>
	@endforeach
	</ul>
	<div class="page"> {!! $xitong -> links() !!}</div>
</div>
</div>
<script type="text/javascript">
	
	
	layui.use('form',function(){
		var form = layui.form();
		form.render();
	});
	

	//查看消息
	$('ul.system li a').on('click', function() {
		var thisA = $(this);
		var id = $(this).attr('id');
		$.post('/message/xitongxq', {'id':id}, function(str) {
			layer.open({
				type: 1,
				title : '系统消息',
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
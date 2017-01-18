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
<div class="headTitle">交易提醒</div>
<div class="message">
	<ul class="business">
	@foreach ($deal as $jiaoyi)
		<li>
			<div class="left">
				<i class="layui-icon">&#xe623;</i>
				<a href="javascript:void(0);" id="{{ $jiaoyi -> id}}">{{$jiaoyi -> title}}</a>
				@if($jiaoyi -> newsstate == 0)
				<button class="layui-btn layui-btn-mini layui-btn-danger newIcon">NEW</button>
				@endif
			</div>
			<div class="right">
				<i class="layui-icon delBtn" id='{{$jiaoyi -> id}}'>&#xe640;</i>
				<span class="titme">{{date('Y-m-d H:i:s',$jiaoyi -> newstime)}}</span>
			</div>
		</li>
	@endforeach	
	</ul>
	<div class="page"> </div>
</div>
</div>
<script type="text/javascript">
	$('.delBtn').on('click', function() {

		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('您真的要删除吗？', {
			btn: ['删除','算了']
		},function(){//确认
			$.ajax({
				url : '/message/deletedeal',
				data : {'id':id},
				type : 'post',
				success : function(data){
					if (data.status == 1) {
						layer.msg(data.msg);
						window.location.href="/message/deal"; 
					}else{
						layer.msg(data.msg);
					}
					
				}
			});	
		},function(){//取消
			layer.msg('已取消',{
				time : 2000
			});
		});	
	});	
	
	//查看消息
	$('ul.business li a').on('click', function() {
		var thisA = $(this);
		var id = $(this).attr('id');
		$.post('/message/dealxq', {'id':id}, function(str) {
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
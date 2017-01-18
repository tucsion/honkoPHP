@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-文章收藏';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">


<div class="headTitle">收藏的文章</div>
<div class="collection">
	<ul class="article">
	@if(empty($wz))
	<li> 暂无数据</li>
	@endif
	@foreach($wz as $wza)
		<li class="transition">
			<i class="layui-icon">&#xe623;</i>[<a href="{{ url('/expert/detail')}}/{{$wza -> uid}}">{{$wza -> zjname}}</a>]
			<a class="title" href="{{ url('expert/wenzang')}}/{{$wza -> gid}}">{{$wza -> name}}</a>
			<span class="transition">
				@if($wza -> status == 0 or empty($wza -> status))
				<button class="layui-btn layui-btn-danger layui-btn-mini">未付费</button>
				<button class="layui-btn layui-btn-primary layui-btn-mini layui-icon delBtn" id='{{$wza -> id}}'><i class="layui-icon delBtn" >&#xe640;</i></button>
				@elseif($wza -> status == 1)
				<button class="layui-btn layui-btn-normal layui-btn-mini">已付费</button>
				<button class="layui-btn layui-btn-primary layui-btn-mini layui-icon delBtn" id='{{$wza -> id}}'><i class="layui-icon delBtn" id='{{$wza -> id}}'>&#xe640;</i></button>
				{{ date('Y-m-d',$wza -> dtime)}}
				@endif
				
			</span>
		</li>
	@endforeach
	</ul>
	<div class="page"> {!! $wz ->links() !!}</div>
</div>
</div>
<script type="text/javascript">
	$('.delBtn').on('click', function() {
		var delTr = $(this).parents('tr');
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('删除操作不可撤销!', {
			btn: ['删除','算了']
		},function(){//确认
			$.ajax({
				url : '/fav/deletewz',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/fav/wz"; 
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
</script>
@endsection

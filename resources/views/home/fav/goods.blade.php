@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-器械收藏';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">



<div class="headTitle">收藏的器械</div>
<div class="collection">
	<ul class="device">
	@if(empty($goods))
	<li> 暂无数据</li>
	@endif
	@foreach($good as $goodss)
		<li class="transition">
			<div class="bg"></div>
			<div class="tools">
				<button title="删除" class="layui-btn layui-btn-warm layui-btn-small delBtn" id="{{ $goodss -> id}}">
					<i class="layui-icon">&#xe640;</i>
				</button>
				<a href="{{ url('/store/detail')}}/{{$goodss -> gid}}" title="查看" class="layui-btn layui-btn-warm layui-btn-small" target="_blank">
					<i class="layui-icon">&#xe64c;</i>
				</a>
			</div>
			<img src="{{ url('/updates')}}/{{$goodss -> img}}" alt="产品名称">
			<p class="title">{{$goodss -> favname}}</p>
			<p class="price">￥{{$goodss -> price}} <span><del></del></span></p>
		</li>
	@endforeach
	</ul>
	<div id="page">{!! $good->links() !!}</div>
</div>
</div>
<script type="text/javascript">

	$('.device li').on('mouseenter', function() {
		$(this).children('.bg,.tools').fadeIn('slow');
	}).mouseleave(function() {
		$(this).children('.bg,.tools').fadeOut('fast');
	});
	$('.delBtn').on('click', function() {
		var delTr = $(this).parents('tr');
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('删除操作不可撤销!', {
			btn: ['删除','算了']
		},function(){//确认
			$.ajax({
				url : '/fav/deletegoods',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/fav/goods"; 
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
@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-专家收藏';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">


<div class="headTitle">收藏的专家</div>
<div class="collection">
	<ul class="expert">
	@if(empty($zj))
	<li> 暂无数据</li>
	@endif
	@foreach($zj as $zjia)
		<li class="transition">
			<a href="{{ url('/expert/detail')}}/{{$zjia -> gid}}" class="img">
				<img src="{{ url('/updates')}}/{{$zjia -> headurl}}" alt="专家名称">
			</a>
			<div class="info">
				<p class="name">
					<span>{{$zjia -> uname}}</span>{{ $zjia -> zhicheng }}
				</p>
				<p class="keshi">
				@foreach($keshi as $k)	
				@if(strpos($zjia -> keshi,(string)$k -> id) !== false)
				{{ $k -> name}}&nbsp;
				@endif
				@endforeach
				</p>
				<p class="shanchang">
					<span>擅长：</span>{{$zjia -> shanchang}}
				</p>
			</div>
			<div class="tools transition">
				<button class="layui-btn layui-btn-mini layui-btn-primary delBtn" id='{{$zjia -> id}}'title="删除">
					<i class="layui-icon">&#xe640;</i>
				</button>
				<a href="{{ url('/expert/detail')}}/{{$zjia -> gid}}" target="_blank" class="layui-btn layui-btn-mini layui-btn-primary" title="查看">
					<i class="layui-icon">&#xe64c;</i>
				</a>
			</div>
		</li>
	@endforeach
	</ul>
	<div class="page">
	{!! $zj->links() !!}
	</div>
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
				url : '/fav/deletezj',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/fav/zj"; 
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


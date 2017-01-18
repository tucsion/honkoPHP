@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-关注的病人';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">


<div class="headTitle">关注的病人</div>
<div class="collection">
@if(session('blxq'))
	<script type="text/javascript">
		alert('该病例可能已被删除');
	</script>
	@endif
	<ul class="expert">
	@if(empty($gz))
	<li> 暂无数据</li>
	@endif
	@foreach($gz as $guanzhu)
		<li class="transition">
			<a href="{{url('/home/tuisong/blxq')}}/{{$guanzhu -> bid}}" class="img">
				<img src="{{ url('/updates')}}/{{$guanzhu -> headurl}}" alt="患者头像">
			</a>
			<div class="info">
				<p class="name">
					<span>{{$guanzhu -> cname}}</span>{{$guanzhu -> dname}}
				</p>
				<p class="keshi">
				@foreach($keshi as $k)	
				@if($guanzhu -> type == $k -> id)
				{{ $k -> name}}&nbsp;
				@endif
				@endforeach
				</p>
				<p class="shanchang">
					{{$guanzhu -> explain}}
				</p>
			</div>
			<div class="tools transition">
				<button class="layui-btn layui-btn-mini layui-btn-primary delBtn" id='{{$guanzhu -> id}}'title="删除">
					<i class="layui-icon">&#xe640;</i>
				</button>
				<a href="{{url('/home/tuisong/blxq')}}/{{$guanzhu -> id}}" target="_blank" class="layui-btn layui-btn-mini layui-btn-primary" title="查看病例信息">
					<i class="layui-icon">&#xe64c;</i>
				</a>
			</div>
		</li>
	@endforeach
	</ul>
	<div class="page">
	{!! $gz->links() !!}
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
				url : '/home/tuisong/deletegz',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/home/tuisong/gz"; 
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

